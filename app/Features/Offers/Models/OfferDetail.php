<?php

namespace App\Features\Offers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'offerable_id',
        'offerable_type',
        'offer_id'
    ];

    public function offerable()
    {
        return $this->morphTo('offerable');
    }

}
