<?php

namespace App\Features\User\Models;

use App\Features\CompanyProfile\Models\City;
use App\Features\CompanyProfile\Models\Country;
use App\Features\CompanyProfile\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'client_id',
        'name',
        'country_id',
        'city_id',
        'governorate_id',
        'street',

    ];


    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id');
    }
}
