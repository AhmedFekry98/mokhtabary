<?php

namespace App\Features\CompanyProfile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'governorate_id',
        'name_ar',
        'name_en',
    ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }
}
