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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
