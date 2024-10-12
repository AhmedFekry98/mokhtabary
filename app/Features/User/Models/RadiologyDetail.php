<?php

namespace App\Features\User\Models;

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
        'country',
        'city',
        'state',
        'street',
        'post_code',
        'description',
    ];

    public function parant(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
