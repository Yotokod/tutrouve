<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Workflow Escrow Status
            $table->enum('escrow_status', [
                'pending',           // Transaction initiée, en attente paiement
                'paid',              // Paiement effectué, fonds bloqués
                'shipped',           // Vendeur a envoyé le produit
                'buyer_confirmed',   // Acheteur a confirmé réception
                'seller_confirmed',  // Vendeur a confirmé
                'both_confirmed',    // Les deux ont confirmé
                'completed',         // Transaction complétée (fonds libérés au vendeur)
                'disputed',          // Litige en cours
                'cancelled',         // Transaction annulée
                'refunded'           // Remboursement effectué
            ])->default('pending')->after('transaction_id');
            
            // Confirmations des parties
            $table->boolean('buyer_confirmed')->default(false)->after('escrow_status');
            $table->boolean('seller_confirmed')->default(false)->after('buyer_confirmed');
            $table->timestamp('buyer_confirmed_at')->nullable()->after('seller_confirmed');
            $table->timestamp('seller_confirmed_at')->nullable()->after('buyer_confirmed_at');
            $table->timestamp('admin_reviewed_at')->nullable()->after('seller_confirmed_at');
            $table->unsignedBigInteger('admin_reviewed_by')->nullable()->after('admin_reviewed_at');
            
            // Notes et messages
            $table->text('buyer_notes')->nullable()->after('admin_reviewed_by')->comment('Notes/commentaires de l\'acheteur');
            $table->text('seller_notes')->nullable()->after('buyer_notes')->comment('Notes/commentaires du vendeur');
            $table->text('admin_notes')->nullable()->after('seller_notes')->comment('Notes admin (raison rejet, etc)');
            
            // Informations paiement (pour PayDunya, etc.)
            $table->string('payment_gateway', 50)->nullable()->after('admin_notes')->comment('paydunya, stripe, paypal, etc.');
            $table->string('payment_reference', 255)->nullable()->after('payment_gateway')->comment('Référence transaction gateway');
            $table->string('payment_status', 50)->nullable()->after('payment_reference')->comment('success, pending, failed');
            $table->timestamp('paid_at')->nullable()->after('payment_status')->comment('Date paiement effectif');
            
            // Tracking numéro de suivi
            $table->string('tracking_number', 100)->nullable()->after('paid_at')->comment('Numéro suivi colis');
            
            // Commission plateforme
            $table->decimal('platform_fee', 15, 2)->nullable()->after('tracking_number')->default(0)->comment('Commission prélevée par Tutrouve');
            $table->decimal('seller_amount', 15, 2)->nullable()->after('platform_fee')->comment('Montant net vendeur après commission');
            
            // Foreign key constraint pour admin_reviewed_by
            $table->foreign('admin_reviewed_by')->references('id')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['admin_reviewed_by']);
            
            $table->dropColumn([
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
            ]);
        });
    }
};
