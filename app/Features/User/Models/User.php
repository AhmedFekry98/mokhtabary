<?php

namespace App\Features\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, HasApiTokens , InteractsWithMedia;

    protected $fillable =[
        'email',
        'phone',
        'phone_verified_at',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password'    => 'hashed',
        'phone_verified_at' => 'datetime',
    ];


    public function clientDetail()
    {
        return $this->hasOne(ClientDetail::class , 'client_id');
    }

    public function familyDetail()
    {
        return $this->hasOne(FamilyDetail::class , 'client_id');
    }

    public function labDetail()
    {
        return $this->hasOne(LabDetail::class , 'lab_id');
    }

    public function radiologyDetail()
    {
        return $this->hasOne(RadiologyDetail::class , 'radiology_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    // to get role
    public function getRoleAttribute(): ?Role
    {
        return $this->roles()->first();
    }

    // To add Assign Role
    public function assignRole(string $name)
    {
        try {
            $role = Role::where('name', $name)->firstOrFail();
            $this->roles()->sync($role->id);
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    public function verificationCodes()
    {
        return $this->hasMany(VerificationCode::class, 'user_id');
    }

    public function createVerificationCode($expireAt = null)
    {
        if (! $expireAt) {
            $expireAt = now()->addMinute();
        }

        return $this->verificationCodes()->create([
            'code'  => random_int(1000, 9999),
            'expired_at' => $expireAt
        ]);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('users')
            ->singleFile()
            // ->useFallbackPath()
            ->useFallbackUrl(
                asset('/img/default-img.jpg')
            );
    }

}
