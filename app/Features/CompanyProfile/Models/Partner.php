<?php

namespace App\Features\CompanyProfile\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Partner extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        //
    ];

    public function registerAllMediaConversions(?Media $media = null): void
    {
        $this->addMediaCollection('partner')
            ->singleFile();
    }
}
