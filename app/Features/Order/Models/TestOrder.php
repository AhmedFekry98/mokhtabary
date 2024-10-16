<?php

namespace App\Features\Order\Models;

use App\Features\Lab\Models\LabTest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_test_id',
        'order_id'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function labTest()
    {
        return $this->belongsTo(LabTest::class , 'lab_test_id') ;
    }
}
