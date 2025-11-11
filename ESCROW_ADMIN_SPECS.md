# Spécifications - Page Admin Approbation Escrow

## Vue d'ensemble

Page d'administration permettant de gérer les transactions Escrow entre acheteurs et vendeurs sur Tutrouve. Le système nécessite l'approbation des deux parties avant de libérer les fonds au vendeur.

## Architecture

### Route Suggérée
```php
Route::get('/admin/escrow/transactions', [EscrowController::class, 'index'])->name('admin.escrow.transactions');
Route::post('/admin/escrow/approve/{id}', [EscrowController::class, 'approve'])->name('admin.escrow.approve');
Route::post('/admin/escrow/reject/{id}', [EscrowController::class, 'reject'])->name('admin.escrow.reject');
```

### Base de données (Table `transactions` existante)

Si la table n'existe pas, créer une migration :

```php
Schema::create('escrow_transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
    $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
    $table->decimal('amount', 15, 2);
    $table->string('transaction_id')->unique();
    $table->enum('status', [
        'pending',           // En attente
        'buyer_approved',    // Acheteur a approuvé
        'seller_approved',   // Vendeur a approuvé
        'both_approved',     // Les deux ont approuvé
        'completed',         // Transaction complétée (argent libéré)
        'disputed',          // Litige
        'cancelled',         // Annulée
        'refunded'           // Remboursée
    ])->default('pending');
    $table->boolean('buyer_confirmed')->default(false);
    $table->boolean('seller_confirmed')->default(false);
    $table->timestamp('buyer_confirmed_at')->nullable();
    $table->timestamp('seller_confirmed_at')->nullable();
    $table->timestamp('admin_reviewed_at')->nullable();
    $table->foreignId('admin_reviewed_by')->nullable()->constrained('admins');
    $table->text('buyer_notes')->nullable();
    $table->text('seller_notes')->nullable();
    $table->text('admin_notes')->nullable();
    $table->string('payment_gateway')->nullable();
    $table->string('payment_reference')->nullable();
    $table->timestamps();
});
```

## Design de la Page Admin

### 1. En-tête avec statistiques

```html
<div class="escrow-admin-header">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="las la-clock"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $pendingCount }}</h3>
                <p>En attente</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon approved">
                <i class="las la-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $approvedCount }}</h3>
                <p>Approuvées</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon completed">
                <i class="las la-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <h3>{{ number_format($totalAmount) }} FCFA</h3>
                <p>Montant total</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon disputed">
                <i class="las la-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $disputedCount }}</h3>
                <p>Litiges</p>
            </div>
        </div>
    </div>
</div>
```

### 2. Filtres et recherche

```html
<div class="escrow-filters">
    <form method="GET" action="{{ route('admin.escrow.transactions') }}">
        <div class="filters-row">
            <div class="filter-item">
                <select name="status" class="form-control">
                    <option value="">Tous les statuts</option>
                    <option value="pending">En attente</option>
                    <option value="buyer_approved">Acheteur approuvé</option>
                    <option value="seller_approved">Vendeur approuvé</option>
                    <option value="both_approved">Les deux approuvés</option>
                    <option value="completed">Complétée</option>
                    <option value="disputed">Litige</option>
                </select>
            </div>
            
            <div class="filter-item">
                <input type="text" name="search" placeholder="Rechercher par ID, nom..." class="form-control">
            </div>
            
            <div class="filter-item">
                <input type="date" name="date_from" class="form-control">
            </div>
            
            <div class="filter-item">
                <input type="date" name="date_to" class="form-control">
            </div>
            
            <button type="submit" class="btn-filter">
                <i class="las la-filter"></i> Filtrer
            </button>
        </div>
    </form>
</div>
```

### 3. Tableau des transactions

```html
<div class="escrow-transactions-table">
    <table class="table-modern">
        <thead>
            <tr>
                <th>ID</th>
                <th>Annonce</th>
                <th>Acheteur</th>
                <th>Vendeur</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Approbations</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>#{{ $transaction->id }}</td>
                <td>
                    <a href="{{ route('frontend.listing.details', $transaction->listing->slug) }}" target="_blank">
                        {{ Str::limit($transaction->listing->title, 40) }}
                    </a>
                </td>
                <td>
                    <div class="user-cell">
                        <img src="{{ userProfileImage($transaction->buyer->image) }}" alt="">
                        <span>{{ $transaction->buyer->fullname }}</span>
                    </div>
                </td>
                <td>
                    <div class="user-cell">
                        <img src="{{ userProfileImage($transaction->seller->image) }}" alt="">
                        <span>{{ $transaction->seller->fullname }}</span>
                    </div>
                </td>
                <td class="amount-cell">{{ number_format($transaction->amount) }} FCFA</td>
                <td>
                    <span class="status-badge status-{{ $transaction->status }}">
                        {{ __(ucfirst(str_replace('_', ' ', $transaction->status))) }}
                    </span>
                </td>
                <td>
                    <div class="approval-status">
                        <div class="approval-item {{ $transaction->buyer_confirmed ? 'confirmed' : 'pending' }}">
                            <i class="las la-user"></i> Acheteur
                            @if($transaction->buyer_confirmed)
                                <i class="las la-check-circle"></i>
                            @else
                                <i class="las la-clock"></i>
                            @endif
                        </div>
                        <div class="approval-item {{ $transaction->seller_confirmed ? 'confirmed' : 'pending' }}">
                            <i class="las la-store"></i> Vendeur
                            @if($transaction->seller_confirmed)
                                <i class="las la-check-circle"></i>
                            @else
                                <i class="las la-clock"></i>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="actions-cell">
                        <button class="btn-action btn-view" onclick="viewTransaction({{ $transaction->id }})">
                            <i class="las la-eye"></i>
                        </button>
                        
                        @if($transaction->status === 'both_approved')
                            <form method="POST" action="{{ route('admin.escrow.approve', $transaction->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-action btn-approve" onclick="return confirm('Libérer les fonds au vendeur?')">
                                    <i class="las la-check"></i>
                                </button>
                            </form>
                        @endif
                        
                        <button class="btn-action btn-dispute" onclick="openDisputeModal({{ $transaction->id }})">
                            <i class="las la-exclamation-circle"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $transactions->links() }}
</div>
```

### 4. Modal Détails Transaction

```html
<div class="modal fade" id="transactionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails Transaction #<span id="transactionId"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="transaction-details">
                    <!-- Timeline Escrow -->
                    <div class="escrow-timeline">
                        <div class="timeline-item completed">
                            <div class="timeline-icon">
                                <i class="las la-plus-circle"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Transaction initiée</h4>
                                <p id="createdAt"></p>
                            </div>
                        </div>
                        
                        <div class="timeline-item" id="buyerApprovalStep">
                            <div class="timeline-icon">
                                <i class="las la-user"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Confirmation acheteur</h4>
                                <p id="buyerStatus"></p>
                            </div>
                        </div>
                        
                        <div class="timeline-item" id="sellerApprovalStep">
                            <div class="timeline-icon">
                                <i class="las la-store"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Confirmation vendeur</h4>
                                <p id="sellerStatus"></p>
                            </div>
                        </div>
                        
                        <div class="timeline-item" id="adminApprovalStep">
                            <div class="timeline-icon">
                                <i class="las la-shield-alt"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Libération des fonds</h4>
                                <p id="adminStatus"></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="notes-section">
                        <h5>Notes de l'acheteur</h5>
                        <p id="buyerNotes"></p>
                        
                        <h5>Notes du vendeur</h5>
                        <p id="sellerNotes"></p>
                        
                        <h5>Notes administrateur</h5>
                        <form id="adminNotesForm">
                            <textarea name="admin_notes" class="form-control" rows="3" placeholder="Ajouter une note..."></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
```

## Couleurs de Design (conformes au design system #1F3E39)

```css
:root {
    --primary-color: #1F3E39;
    --success: #22C55E;
    --warning: #F59E0B;
    --danger: #EF4444;
    --info: #3B82F6;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
}

.status-pending { background: #FEF3C7; color: #F59E0B; }
.status-buyer_approved { background: #DBEAFE; color: #3B82F6; }
.status-seller_approved { background: #E0E7FF; color: #6366F1; }
.status-both_approved { background: #D1FAE5; color: #10B981; }
.status-completed { background: #D1FAE5; color: #059669; }
.status-disputed { background: #FEE2E2; color: #DC2626; }
.status-cancelled { background: #F3F4F6; color: #6B7280; }
```

## Logique Métier

### Workflow Transaction Escrow

1. **Création** : L'acheteur initie la transaction avec un montant
2. **Paiement** : L'acheteur paie (via PayDunya, etc.) - fonds bloqués
3. **Expédition** : Le vendeur envoie le produit
4. **Réception** : L'acheteur confirme la réception (buyer_confirmed = true)
5. **Validation vendeur** : Le vendeur confirme la transaction (seller_confirmed = true)
6. **Approbation admin** : Si les deux ont confirmé, l'admin peut libérer les fonds
7. **Libération** : Les fonds sont transférés au vendeur (status = 'completed')

### Règles de Validation

- ✅ Admin peut libérer les fonds SEULEMENT si `buyer_confirmed = true` ET `seller_confirmed = true`
- ✅ Admin peut marquer comme litige à tout moment
- ✅ Transaction peut être annulée dans les 24h si aucune confirmation
- ✅ Remboursement automatique si litige résolu en faveur de l'acheteur

## Notifications

### Email à envoyer

1. **Acheteur paie** → Email au vendeur : "Vous avez reçu une commande"
2. **Vendeur confirme** → Email à l'acheteur : "Votre commande a été expédiée"
3. **Acheteur confirme** → Email au vendeur : "L'acheteur a confirmé la réception"
4. **Les deux confirment** → Email à l'admin : "Transaction prête à être finalisée"
5. **Admin libère** → Email au vendeur : "Vous avez reçu votre paiement"

## Améliorations Futures

- [ ] Dashboard Escrow pour acheteurs/vendeurs
- [ ] Système de tracking de colis
- [ ] Chat intégré pour les transactions
- [ ] Système de notation post-transaction
- [ ] Gestion automatique des litiges (délai, escalade)
- [ ] Export des transactions en CSV/Excel
- [ ] Webhooks pour intégration paiement en temps réel

## Sécurité

- Vérifier l'identité de l'admin via 2FA
- Logger toutes les actions (approbations, rejets, notes)
- Limiter le nombre de tentatives de modification
- Alerte automatique si montant inhabituel (>500,000 FCFA)
- Protection CSRF sur tous les formulaires

---

**Prochaine étape** : Créer le contrôleur, les vues Blade et les styles CSS pour cette page admin.
