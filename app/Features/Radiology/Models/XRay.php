<?php

namespace App\Features\Radiology\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XRay extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_code',
        'code',
        'name_en',
        'name_ar',
    ];

    public static function newFactory()
    {
        return \database\factories\XRayFactory::new();
    }

    public function radiologyxRay()
    {
        return $this->hasOne(RadiologyxRay::class, 'x_ray_id');
    }

}
