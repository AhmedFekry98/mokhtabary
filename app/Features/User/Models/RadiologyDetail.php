<?php

namespace App\Features\User\Models;

use App\Features\CompanyProfile\Models\City;
use App\Features\CompanyProfile\Models\Country;
use App\Features\CompanyProfile\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RadiologyDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'radiology_id',
        'parent_id',
        'name',
        'country_id',
        'city_id',
        'governorate_id',
        'street',
        'description',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }


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
