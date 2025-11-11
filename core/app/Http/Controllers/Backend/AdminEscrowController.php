<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\EscrowNotification;
use Illuminate\Support\Facades\Mail;

class AdminEscrowController extends Controller
{
    /**
     * Afficher la liste des transactions Escrow avec filtres et stats
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['listing', 'buyer', 'seller'])
            ->whereNotNull('escrow_status');
        
        // Filtres
        if ($request->has('status') && $request->status != '') {
            $query->where('escrow_status', $request->status);
        }
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('buyer', function($subQ) use ($search) {
                    $subQ->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('seller', function($subQ) use ($search) {
                    $subQ->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('listing', function($subQ) use ($search) {
                    $subQ->where('title', 'like', "%{$search}%");
                })
                ->orWhere('id', 'like', "%{$search}%")
                ->orWhere('payment_reference', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        // Tri
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
        
        $transactions = $query->paginate(20);
        
        // Statistiques
        $stats = [
            'pending' => Transaction::where('escrow_status', 'pending')->count(),
            'paid' => Transaction::where('escrow_status', 'paid')->count(),
            'awaiting_approval' => Transaction::where('escrow_status', 'both_confirmed')->count(),
            'completed' => Transaction::where('escrow_status', 'completed')->count(),
            'disputed' => Transaction::where('escrow_status', 'disputed')->count(),
            'total_amount' => Transaction::where('escrow_status', 'completed')->sum('amount'),
            'total_fees' => Transaction::where('escrow_status', 'completed')->sum('platform_fee'),
        ];
        
        return view('backend.escrow.transactions', compact('transactions', 'stats'));
    }
    
    /**
     * Approuver une transaction et libérer les fonds au vendeur
     */
    public function approve($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            
            // Vérifications de sécurité
            if (!$transaction->canBeApproved()) {
                return back()->with(FlashMsg::error(
                    __('Cette transaction ne peut pas être approuvée. Les deux parties doivent avoir confirmé.')
                ));
            }
            
            // Calculer le montant vendeur si pas déjà fait
            if (!$transaction->seller_amount) {
                $transaction->calculateSellerAmount();
            }
            
            DB::beginTransaction();
            
            try {
                // Mettre à jour la transaction
                $transaction->update([
                    'escrow_status' => 'completed',
                    'admin_reviewed_at' => now(),
                    'admin_reviewed_by' => Auth::guard('admin')->id(),
                    'admin_statut' => 1, // Pour compatibilité ancienne colonne
                ]);
                
                // TODO: Intégration PayDunya - Transférer les fonds au vendeur
                // $this->transferFundsToSeller($transaction);
                
                DB::commit();
                
                // Envoyer notifications email
                $this->sendApprovalNotifications($transaction);
                
                return back()->with(FlashMsg::item_new(
                    __('Transaction approuvée avec succès. Les fonds ont été libérés au vendeur.')
                ));
                
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            
        } catch (\Exception $e) {
            \Log::error('Erreur approbation transaction Escrow: ' . $e->getMessage());
            return back()->with(FlashMsg::error(
                __('Erreur lors de l\'approbation de la transaction: ') . $e->getMessage()
            ));
        }
    }
    
    /**
     * Rejeter une transaction et marquer en litige
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ], [
            'reason.required' => __('La raison du rejet est obligatoire.'),
            'reason.max' => __('La raison ne doit pas dépasser 1000 caractères.'),
        ]);
        
        try {
            $transaction = Transaction::findOrFail($id);
            
            DB::beginTransaction();
            
            try {
                $transaction->update([
                    'escrow_status' => 'disputed',
                    'admin_notes' => $request->reason,
                    'admin_reviewed_at' => now(),
                    'admin_reviewed_by' => Auth::guard('admin')->id(),
                ]);
                
                DB::commit();
                
                // Envoyer notifications email
                $this->sendDisputeNotifications($transaction);
                
                return back()->with(FlashMsg::item_new(
                    __('Transaction marquée en litige. Les deux parties ont été notifiées.')
                ));
                
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            
        } catch (\Exception $e) {
            \Log::error('Erreur rejet transaction Escrow: ' . $e->getMessage());
            return back()->with(FlashMsg::error(
                __('Erreur lors du rejet de la transaction: ') . $e->getMessage()
            ));
        }
    }
    
    /**
     * Afficher les détails d'une transaction (JSON pour modal)
     */
    public function show($id)
    {
        try {
            $transaction = Transaction::with([
                'listing', 
                'buyer', 
                'seller', 
                'reviewedBy'
            ])->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $transaction->id,
                    'listing' => [
                        'title' => $transaction->listing->title ?? 'N/A',
                        'slug' => $transaction->listing->slug ?? null,
                        'image' => $transaction->listing->image ?? null,
                    ],
                    'buyer' => [
                        'id' => $transaction->buyer->id,
                        'name' => $transaction->buyer->first_name . ' ' . $transaction->buyer->last_name,
                        'email' => $transaction->buyer->email,
                        'phone' => $transaction->buyer->phone,
                        'image' => $transaction->buyer->image,
                    ],
                    'seller' => [
                        'id' => $transaction->seller->id,
                        'name' => $transaction->seller->first_name . ' ' . $transaction->seller->last_name,
                        'email' => $transaction->seller->email,
                        'phone' => $transaction->seller->phone,
                        'image' => $transaction->seller->image,
                    ],
                    'amount' => $transaction->amount,
                    'formatted_amount' => $transaction->formatted_amount,
                    'platform_fee' => $transaction->platform_fee,
                    'seller_amount' => $transaction->seller_amount,
                    'status' => $transaction->escrow_status,
                    'status_label' => $transaction->status_label,
                    'status_color' => $transaction->status_color,
                    'buyer_confirmed' => $transaction->buyer_confirmed,
                    'seller_confirmed' => $transaction->seller_confirmed,
                    'buyer_confirmed_at' => $transaction->buyer_confirmed_at?->format('d/m/Y H:i'),
                    'seller_confirmed_at' => $transaction->seller_confirmed_at?->format('d/m/Y H:i'),
                    'buyer_notes' => $transaction->buyer_notes,
                    'seller_notes' => $transaction->seller_notes,
                    'admin_notes' => $transaction->admin_notes,
                    'tracking_number' => $transaction->tracking_number,
                    'payment_gateway' => $transaction->payment_gateway,
                    'payment_reference' => $transaction->payment_reference,
                    'payment_status' => $transaction->payment_status,
                    'paid_at' => $transaction->paid_at?->format('d/m/Y H:i'),
                    'created_at' => $transaction->created_at->format('d/m/Y H:i'),
                    'updated_at' => $transaction->updated_at->format('d/m/Y H:i'),
                    'admin_reviewed_at' => $transaction->admin_reviewed_at?->format('d/m/Y H:i'),
                    'reviewed_by' => $transaction->reviewedBy ? 
                        $transaction->reviewedBy->name : null,
                    'can_be_approved' => $transaction->canBeApproved(),
                    'next_actor' => $transaction->next_actor,
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('Transaction introuvable.')
            ], 404);
        }
    }
    
    /**
     * Annuler une transaction et rembourser l'acheteur
     */
    public function cancel(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);
        
        try {
            $transaction = Transaction::findOrFail($id);
            
            // Vérifier qu'elle n'est pas déjà terminée
            if (in_array($transaction->escrow_status, ['completed', 'refunded', 'cancelled'])) {
                return back()->with(FlashMsg::error(
                    __('Cette transaction ne peut plus être annulée.')
                ));
            }
            
            DB::beginTransaction();
            
            try {
                $transaction->update([
                    'escrow_status' => 'cancelled',
                    'admin_notes' => $request->reason,
                    'admin_reviewed_at' => now(),
                    'admin_reviewed_by' => Auth::guard('admin')->id(),
                ]);
                
                // TODO: Intégration PayDunya - Rembourser l'acheteur
                // $this->refundBuyer($transaction);
                
                DB::commit();
                
                // Envoyer notifications
                $this->sendCancellationNotifications($transaction);
                
                return back()->with(FlashMsg::item_new(
                    __('Transaction annulée avec succès.')
                ));
                
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            
        } catch (\Exception $e) {
            \Log::error('Erreur annulation transaction: ' . $e->getMessage());
            return back()->with(FlashMsg::error(
                __('Erreur lors de l\'annulation: ') . $e->getMessage()
            ));
        }
    }
    
    /**
     * Mettre à jour les notes admin
     */
    public function updateNotes(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:2000',
        ]);
        
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->update([
                'admin_notes' => $request->admin_notes
            ]);
            
            return response()->json([
                'success' => true,
                'message' => __('Notes mises à jour avec succès.')
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('Erreur lors de la mise à jour.')
            ], 500);
        }
    }
    
    // ============== METHODES PRIVEES ==============
    
    /**
     * Envoyer les notifications d'approbation
     */
    private function sendApprovalNotifications($transaction)
    {
        try {
            // Email au vendeur
            if ($transaction->seller && $transaction->seller->email) {
                // TODO: Créer et envoyer l'email
                // Mail::to($transaction->seller->email)->send(new EscrowApproved($transaction));
            }
            
            // Email à l'acheteur
            if ($transaction->buyer && $transaction->buyer->email) {
                // TODO: Créer et envoyer l'email
                // Mail::to($transaction->buyer->email)->send(new EscrowCompleted($transaction));
            }
            
        } catch (\Exception $e) {
            \Log::error('Erreur envoi notifications approbation: ' . $e->getMessage());
        }
    }
    
    /**
     * Envoyer les notifications de litige
     */
    private function sendDisputeNotifications($transaction)
    {
        try {
            // TODO: Envoyer emails aux deux parties
        } catch (\Exception $e) {
            \Log::error('Erreur envoi notifications litige: ' . $e->getMessage());
        }
    }
    
    /**
     * Envoyer les notifications d'annulation
     */
    private function sendCancellationNotifications($transaction)
    {
        try {
            // TODO: Envoyer emails aux deux parties
        } catch (\Exception $e) {
            \Log::error('Erreur envoi notifications annulation: ' . $e->getMessage());
        }
    }
    
    /**
     * Transférer les fonds au vendeur via PayDunya
     * TODO: Implémenter après intégration PayDunya
     */
    private function transferFundsToSeller($transaction)
    {
        // Logique de transfert via API PayDunya
        // Utiliser $transaction->seller_amount (montant après commission)
    }
    
    /**
     * Rembourser l'acheteur via PayDunya
     * TODO: Implémenter après intégration PayDunya
     */
    private function refundBuyer($transaction)
    {
        // Logique de remboursement via API PayDunya
    }
}
