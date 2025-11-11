<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Backend\Listing;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $transactions = Transaction::paginate(10); 
    return view('backend.transaction.index', compact('transactions'));  
    }

 public function all_user()
    {$userId = Auth::id();
       $transactions = Transaction::where('seller_id', $userId)->orWhere('buyer_id', $userId)->paginate(10); 
    return view('frontend.transaction.index', compact('transactions'));  
    }
    
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {    
        
    
        $ads = Listing::find($request->ads);
        if($ads){
            $userId = Auth::id();
 

    $transaction = Transaction::create([
        'seller_id' => $ads->user_id,
        'buyer_id' => $userId,
        'ads_id' => $request->ads,
        'amount' => $request->amount,
        'admin_statut' => 0, // Valeur par défaut
        'buyer_statut' => 0, // Valeur par défaut
        'seller_statut' => 0, // Valeur par défaut
        'message' => "",
        'withdraw_amount' => $request->amount,
        'withdraw_methods' => 0,
        'withdraw_details' => 0,
        'transaction_id' => $request->transaction_id ?? null,
    ]);
            
                return redirect()->back()->with('success', 'La transaction a été éffectué.');  
        }else{
            return redirect()->back()->with('error', 'Annonce manquante.');
        
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $userId = Auth::id();
            $transaction = Transaction::with(['listing', 'buyer', 'seller'])
                ->where(function($query) use ($userId) {
                    $query->where('buyer_id', $userId)
                          ->orWhere('seller_id', $userId);
                })
                ->findOrFail($id);
            
            return view('frontend.user.transactions.details', compact('transaction'));
            
        } catch (\Exception $e) {
            return redirect()->route('user.transaction.all')->with('error', __('Transaction introuvable.'));
        }
    }

    /**
     * L'acheteur confirme la réception du produit
     */
    public function confirm_receipt(Request $request, $id)
    {
        try {
            $userId = Auth::id();
            $transaction = Transaction::where('buyer_id', $userId)->findOrFail($id);
            
            // Vérifier le statut
            if (!in_array($transaction->escrow_status, ['shipped', 'seller_confirmed'])) {
                return back()->with('error', __('Cette transaction ne peut pas être confirmée à ce stade.'));
            }
            
            $transaction->update([
                'buyer_confirmed' => true,
                'buyer_confirmed_at' => now(),
                'buyer_statut' => 1, // Compatibilité ancienne colonne
                'buyer_notes' => $request->notes ?? null,
                'escrow_status' => $transaction->seller_confirmed ? 'both_confirmed' : 'buyer_confirmed'
            ]);
            
            // TODO: Envoyer notification au vendeur et admin
            
            return back()->with('success', __('Réception confirmée avec succès.'));
            
        } catch (\Exception $e) {
            return back()->with('error', __('Erreur lors de la confirmation: ') . $e->getMessage());
        }
    }
    
    /**
     * Le vendeur confirme l'expédition du produit
     */
    public function confirm_shipping(Request $request, $id)
    {
        $request->validate([
            'tracking_number' => 'nullable|string|max:100',
        ]);
        
        try {
            $userId = Auth::id();
            $transaction = Transaction::where('seller_id', $userId)->findOrFail($id);
            
            // Vérifier le statut
            if ($transaction->escrow_status !== 'paid') {
                return back()->with('error', __('Le paiement doit être effectué avant l\'expédition.'));
            }
            
            $transaction->update([
                'seller_confirmed' => true,
                'seller_confirmed_at' => now(),
                'seller_statut' => 1, // Compatibilité ancienne colonne
                'seller_notes' => $request->notes ?? null,
                'tracking_number' => $request->tracking_number,
                'escrow_status' => $transaction->buyer_confirmed ? 'both_confirmed' : 'shipped'
            ]);
            
            // TODO: Envoyer notification à l'acheteur
            
            return back()->with('success', __('Expédition confirmée avec succès.'));
            
        } catch (\Exception $e) {
            return back()->with('error', __('Erreur lors de la confirmation: ') . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    
    /**
     * Mettre à jour les informations de retrait (vendeur)
     */
    public function edit_sender(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'withdraw_method' => 'required|integer',
            'withdraw_details' => 'required|string|max:500',
        ]);
        
        try {
            $userId = Auth::id();
            $transaction = Transaction::where('seller_id', $userId)
                ->findOrFail($request->transaction_id);
            
            // Vérifier que la transaction est complétée
            if ($transaction->escrow_status !== 'completed') {
                return back()->with('error', __('La transaction doit être complétée pour ajouter des informations de retrait.'));
            }
            
            $transaction->update([
                'withdraw_methods' => $request->withdraw_method,
                'withdraw_details' => $request->withdraw_details,
            ]);
            
            return back()->with('success', __('Informations de retrait mises à jour.'));
            
        } catch (\Exception $e) {
            return back()->with('error', __('Erreur lors de la mise à jour: ') . $e->getMessage());
        }
    }
    
    /**
     * Mettre à jour les notes de l'acheteur
     */
    public function edit_receiver(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'message' => 'nullable|string|max:1000',
        ]);
        
        try {
            $userId = Auth::id();
            $transaction = Transaction::where('buyer_id', $userId)
                ->findOrFail($request->transaction_id);
            
            $transaction->update([
                'message' => $request->message,
            ]);
            
            return back()->with('success', __('Message mis à jour.'));
            
        } catch (\Exception $e) {
            return back()->with('error', __('Erreur lors de la mise à jour: ') . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
