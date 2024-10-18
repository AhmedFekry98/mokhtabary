<?php

namespace App\Features\Offers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public static $OfferType = [
        'test',
        'xray'
    ];

    public function OfferDetail()
    {
        return $this->hasMany(OfferDetail::class , 'offer_id');
    }
}
