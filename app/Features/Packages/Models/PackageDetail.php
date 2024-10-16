<?php

namespace App\Features\Packages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'packageable_id',
        'packageable_type',
        'package_id',
    ];

    public function packageable()
    {
        return $this->morphTo('packageable');
    }
}
