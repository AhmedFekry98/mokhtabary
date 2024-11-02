<?php

namespace App\Features\Chat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    use HasFactory;

    protected $table = ['chat_users'];

    protected $fillable = [
        'chat_id',
        'user_id'
    ];
}
