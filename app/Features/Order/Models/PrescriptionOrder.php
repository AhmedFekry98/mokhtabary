<?php

namespace App\Features\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'family_detail_id',
        'receiver_id',
        'order_type',
        'status'
    ];

    public static $statuses = [
        'rejected',
        'confirmed',
        'pending'
    ];

    public static $orderTypes = [
        'test',
        'xray'
    ];

}
