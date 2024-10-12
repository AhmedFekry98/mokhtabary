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

    

}
