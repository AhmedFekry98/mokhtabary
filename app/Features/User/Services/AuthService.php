<?php

namespace App\Features\User\Services;

use App\Features\User\Models\User;
use Graphicode\Standard\TDO\TDO;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private static $model = User::class;

    public function login(TDO $tdo)
    {
        try {
            $user = User::firstWhere('email', $tdo->email);

            if (! $user || ! Hash::check($tdo->password, $user->password) ) {
                return "Invalid login data";
            }

            return $user;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout()
    {
        try {
            $user = auth()->user();

            $token = $user->currentAccessToken();

            return $token->delete();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAuthUser()
    {
        try {
            return auth()->user();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getUser(string $userId)
    {
        try {
            $user = User::find($userId);
            return $user;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function changePassword(TDO $tdo)
    {
        try {
            $user =  auth()->user();

            $user->password = Hash::make($tdo->password);
            $user->save();

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateProfile(TDO $tdo)
    {
     $updateData = collect(
            $tdo->all(true)
        )->except([
            'img'
        ])->toArray();

        $auth = $this->getAuthUser();
        $role =  $auth->role->name;


        // Handle image upload if present
        if ($tdo->img) {
            $auth->addMedia($tdo->img)
                ->toMediaCollection('users');
        }

        // Check for admin role
        if ($role === 'admin') {
            return $auth; // Admin does not update any details
        }

         // Handle updates based on user role
        switch ($role) {
            case 'client':
                $auth->clientDetail()->update($updateData);
                break;
            case 'lab':
            case 'labBranch':
                $auth->labDetail()->update($updateData);
                break;
            case 'radiology':
            case 'radiologyBranch':
                $auth->radiologyDetail()->update($updateData);
                break;
            default:
                throw new \InvalidArgumentException("Invalid guard type provided");
        }

        // Return updated auth user object
        return $auth;
    }

}
