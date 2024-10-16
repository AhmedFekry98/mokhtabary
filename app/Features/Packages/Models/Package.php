<?php

namespace App\Features\Packages\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public static $packageType = [
        'test',
        'xray'
    ];

    public function PackageDetail()
    {
        return $this->hasMany(PackageDetail::class , 'package_id');
    }


}
