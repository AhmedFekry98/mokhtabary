<?php

namespace App\Features\CompanyProfile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name_ar',
        'name_en'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id');
    }

    public function governorate()
    {
        return $this->hasMany(City::class , 'governorate_id');
    }
}
