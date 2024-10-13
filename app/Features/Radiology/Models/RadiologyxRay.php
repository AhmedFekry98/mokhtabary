<?php

namespace App\Features\Radiology\Models;

use App\Features\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologyxRay extends Model
{
    use HasFactory;

    protected $fillable = [
        'x_ray_id',
        'radiology_id',
        'contract_price',
        'before_price',
        'after_price',
        'offer_price'
    ];

    public function radiology()
    {
        return $this->belongsTo(User::class , 'radiology_id');
    
    }

    public function xRay()
    {
        return $this->belongsTo(XRay::class , 'x_ray_id');
    }
}
