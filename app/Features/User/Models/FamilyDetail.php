<?php

namespace App\Features\User\Models;

use App\Features\CompanyProfile\Models\City;
use App\Features\CompanyProfile\Models\Country;
use App\Features\CompanyProfile\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FamilyDetail extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable =[
        'client_id',
        'name',
        'country_id',
        'city_id',
        'governorate_id',
        'street',
        'phone',
        'email',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('users')
            ->singleFile()
            // ->useFallbackPath()
            ->useFallbackUrl(
                asset('/img/default-img.jpg')
            );
    }
}
