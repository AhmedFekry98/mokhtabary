<?php

namespace App\Features\Chat\Models;

use App\Features\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        //
    ];

    protected function getSenderAttribute()
    {
        $user = Auth::user();

        $sender = $this->users()
            ->whereNot('user_id', $user->id)
            ->first();

            if (! $sender ) {
                return $user;
            }

            return $sender;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_users');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // public function chats()
    // {
    //     return $this->belongsToMany(Chat::class, 'chat_users');
    // }

}
