<?php

namespace App\Features\Lab\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_code',
        'code',
        'name_en',
        'name_ar',
    ];

    public static function newFactory()
    {
        return \database\factories\TestFactory::new();
    }

    public function labTest()
    {
        return $this->hasOne(LabTest::class, 'test_id');
    }
}
