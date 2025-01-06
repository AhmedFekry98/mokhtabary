<?php

namespace App\Features\Payment\Models;

use App\Features\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabRadiologyPayment extends Model
{
    use HasFactory;

    protected $table = 'lab_radiology_payments';

    protected $fillable = [
        'receiver_id',
        'total_amount_order',
        'total_amount_mokhtabary',
        'vat_precentage',
        'vat_amount',
        'amount_after_vat',
        'total_amount_receiver',
        'tax_percentage',
        'tax_amount',
        'amunt_after_taxes'
    ];


    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
