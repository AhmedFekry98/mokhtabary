<?php

namespace App\Features\CompanyProfile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BasicInformation extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $table = 'basic_informations';

    protected $fillable = [
        'logo', 
        'phone_number', 
        'mobile_number', 
        'whatsapp', 
        'facebook', 
        'instagram', 
        'x', 
        'tiktok', 
        'snapchat', 
        'linkedin', 
        'website', 
        'email_address', 
        'address'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
            ->singleFile()
            ->useFallbackUrl(
                asset('/img/logo-profile.png')
            );
    }
}
