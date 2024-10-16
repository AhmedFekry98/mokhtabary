<?php

namespace App\Features\Order\Models;

use App\Features\Radiology\Models\RadiologyxRay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XRayOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'radiology_x_ray_id',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function radiologyXRay()
    {
        return $this->belongsTo(RadiologyxRay::class , 'radiology_x_ray_id');
    }
}
