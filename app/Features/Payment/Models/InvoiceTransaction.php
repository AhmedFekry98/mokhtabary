<?php

namespace App\Features\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "invoice_id",
        "order_id",
        "payment_method",
        "date_operation",
        "transaction_status",
        "invoice_value_in_base_currency",
        "base_currency",
        "invoice_value_in_pay_currency",
        "pay_currency"
    ];
}
