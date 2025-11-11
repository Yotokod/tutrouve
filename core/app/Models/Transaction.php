<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Backend\Listing;
use App\Models\Backend\Admin;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'seller_id',
        'buyer_id',
        'ads_id',
        'amount',
        'admin_statut',
        'buyer_statut',
        'seller_statut',
        'message',
        'withdraw_amount',
        'withdraw_methods',
        'withdraw_details',
        'transaction_id',
        // Nouvelles colonnes Escrow
        'escrow_status',
        'buyer_confirmed',
        'seller_confirmed',
        'buyer_confirmed_at',
        'seller_confirmed_at',
        'admin_reviewed_at',
        'admin_reviewed_by',
        'buyer_notes',
        'seller_notes',
        'admin_notes',
        'payment_gateway',
        'payment_reference',
        'payment_status',
        'paid_at',
        'tracking_number',
        'platform_fee',
        'seller_amount'
    ];
    
    protected $casts = [
        'buyer_confirmed' => 'boolean',
        'seller_confirmed' => 'boolean',
        'buyer_confirmed_at' => 'datetime',
        'seller_confirmed_at' => 'datetime',
        'admin_reviewed_at' => 'datetime',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'withdraw_amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'seller_amount' => 'decimal:2',
    ];
    
    // ============== RELATIONS ==============
    
    /**
     * L'acheteur de la transaction
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    
    /**
     * Le vendeur de la transaction
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    /**
     * L'annonce concernée
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'ads_id');
    }
    
    /**
     * L'admin qui a traité la transaction
     */
    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_reviewed_by');
    }
    
    // ============== SCOPES ==============
    
    /**
     * Transactions en attente d'approbation admin
     */
    public function scopePendingAdminApproval($query)
    {
        return $query->where('escrow_status', 'both_confirmed')
                     ->whereNull('admin_reviewed_at');
    }
    
    /**
     * Transactions complétées
     */
    public function scopeCompleted($query)
    {
        return $query->where('escrow_status', 'completed');
    }
    
    /**
     * Transactions en litige
     */
    public function scopeDisputed($query)
    {
        return $query->where('escrow_status', 'disputed');
    }
    
    /**
     * Transactions d'un utilisateur (acheteur ou vendeur)
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('buyer_id', $userId)
                     ->orWhere('seller_id', $userId);
    }
    
    /**
     * Transactions par statut
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('escrow_status', $status);
    }
    
    // ============== METHODES HELPER ==============
    
    /**
     * Vérifier si l'utilisateur est l'acheteur
     */
    public function isBuyer($userId): bool
    {
        return $this->buyer_id == $userId;
    }
    
    /**
     * Vérifier si l'utilisateur est le vendeur
     */
    public function isSeller($userId): bool
    {
        return $this->seller_id == $userId;
    }
    
    /**
     * Vérifier si l'utilisateur est impliqué dans la transaction
     */
    public function involvesUser($userId): bool
    {
        return $this->isBuyer($userId) || $this->isSeller($userId);
    }
    
    /**
     * Vérifier si les deux parties ont confirmé
     */
    public function bothPartiesConfirmed(): bool
    {
        return $this->buyer_confirmed && $this->seller_confirmed;
    }
    
    /**
     * Vérifier si la transaction peut être approuvée par l'admin
     */
    public function canBeApproved(): bool
    {
        return $this->escrow_status === 'both_confirmed' && $this->bothPartiesConfirmed();
    }
    
    /**
     * Calculer le montant net du vendeur après commission
     */
    public function calculateSellerAmount(): float
    {
        $feePercentage = get_static_option('escrow_platform_fee') ?? 5; // 5% par défaut
        $this->platform_fee = ($this->amount * $feePercentage) / 100;
        $this->seller_amount = $this->amount - $this->platform_fee;
        
        return $this->seller_amount;
    }
    
    /**
     * Obtenir le statut en français
     */
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'pending' => 'En attente',
            'paid' => 'Payé',
            'shipped' => 'Expédié',
            'buyer_confirmed' => 'Confirmé par l\'acheteur',
            'seller_confirmed' => 'Confirmé par le vendeur',
            'both_confirmed' => 'Confirmé par les deux parties',
            'completed' => 'Terminé',
            'disputed' => 'Litige',
            'cancelled' => 'Annulé',
            'refunded' => 'Remboursé'
        ];
        
        return $labels[$this->escrow_status] ?? $this->escrow_status;
    }
    
    /**
     * Obtenir la couleur badge selon statut
     */
    public function getStatusColorAttribute(): string
    {
        $colors = [
            'pending' => 'warning',
            'paid' => 'info',
            'shipped' => 'primary',
            'buyer_confirmed' => 'success',
            'seller_confirmed' => 'success',
            'both_confirmed' => 'success',
            'completed' => 'success',
            'disputed' => 'danger',
            'cancelled' => 'secondary',
            'refunded' => 'warning'
        ];
        
        return $colors[$this->escrow_status] ?? 'secondary';
    }
    
    /**
     * Formater le montant avec devise
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 0, ',', ' ') . ' FCFA';
    }
    
    /**
     * Obtenir le prochain acteur qui doit agir
     */
    public function getNextActorAttribute(): ?string
    {
        switch ($this->escrow_status) {
            case 'pending':
                return 'acheteur'; // Doit payer
            case 'paid':
                return 'vendeur'; // Doit expédier
            case 'shipped':
                return 'acheteur'; // Doit confirmer réception
            case 'buyer_confirmed':
                return 'vendeur'; // Doit confirmer sa part
            case 'seller_confirmed':
                return 'acheteur'; // Doit confirmer sa part
            case 'both_confirmed':
                return 'admin'; // Doit libérer les fonds
            default:
                return null;
        }
    }
}
