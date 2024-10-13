<?php

namespace App\Features\Lab\Models;

use App\Features\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'lab_id',
        'contract_price',
        'before_price',
        'after_price',
        'offer_price',
    ];

    public function lab()
    {
        return $this->belongsTo(User::class , 'lab_id');
    
    }

    public function test()
    {
        return $this->belongsTo(Test::class , 'test_id');
    }
    
}
