<?php

namespace App\Features\ContactMessage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContactMessage extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    
    protected $fillable = [
        'name',
        'email_address',
        'phone',
        'message',
        'read_at',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')
            ->singleFile()
            ->useFallbackUrl("");
    }
}
