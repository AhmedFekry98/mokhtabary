<?php

namespace App\Features\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        'client_id',
        'name',
        'country',
        'city',
        'state',
        'street',
        'post_code'
    ];
}
