<?php

namespace App\Features\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionMediacl extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_order_id',
        'medicalable_id', // id test or xray model
        'medicalable_type', // class test or xray model
    ];
}
