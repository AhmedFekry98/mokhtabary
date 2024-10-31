<?php

namespace App\Features\Order\Models;

use App\Features\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'receiver_id',
        'branch_id',
        'order_type',
        'visit',
        'delivery',
        'status',
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

    public function testOrder()
    {
        return $this->hasMany(TestOrder::class , 'order_id');
    }

    public function xrayOrder()
    {
        return $this->hasMany(XRayOrder::class , 'order_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class , "client_id" );
    }



}
