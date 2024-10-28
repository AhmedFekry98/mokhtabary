<?php

namespace App\Features\Auditing\Models;

use App\Features\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'action_ar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
