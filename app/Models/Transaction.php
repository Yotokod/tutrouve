<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['seller_id',
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
'transaction_id']; 
}
