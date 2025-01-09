<?php

namespace App\Features\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_id',
        'payment_gateway',
        'transaction_date',
        'transaction_status',
        'total_service_charge',
        'due_value',
        'paid_currency',
        'paid_currency_value',
        'vat_amount',
        'currency',
        'error',
    ];
}
