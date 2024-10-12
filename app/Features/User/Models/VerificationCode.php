<?php

namespace App\Features\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'code',
        'expired_at'
    ];
}
