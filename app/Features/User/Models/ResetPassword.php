<?php

namespace App\Features\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $fillable =[
        'phone',
        'model',
        'code',
        'expired_at',
        'token',
    ];
}
