<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'email', 'billing_address', 'transaction_date',
        'due_date', 'transaction_number', 'customer_reference_number',
        'tag', 'payment_terms', 'warehouse', 'product', 'message',
        'memo', 'attachment', 'sub_total', 'deductions', 'down_payment',
        'remaining_balance',
    ];
        
}
