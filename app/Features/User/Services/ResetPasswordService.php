<?php

namespace App\Features\User\Services;

use App\Features\SmsGetway\Services\WhySmsGetwayService;
use App\Features\User\Models\ResetPassword;
use App\Features\User\Models\User;
use Graphicode\Standard\TDO\TDO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordService
{
    private static $model = User::class;

    public function __construct(
        private WhySmsGetwayService $whySmsGetwayService
    ) {}

    public function forget(TDO $tdo)
    {
  
        $phone = $tdo->phone;

        // Find the user by phone number
        $user = self::$model::where('phone', $phone)->first();
    
        // If no user found, return false
        if (!$user) {
            return false;
        }

        // Generate a random code and set the expiration time
        $code = random_int(10000, 99999);
        $expireAt = now()->addMinutes(5); // Add 5 minutes to the current time

        $resetPassword = ResetPassword::create([
            'phone'     => $phone,
            'model'     => self::$model, // Storing the model class reference
            'code'      => $code,
            'expired_at' => $expireAt
        ]);

        // Send whySmsGetwayService message
        $this->whySmsGetwayService->sendMessage(
            to: $phone,
            message: "Your reset password code is {$code}"
        );

        return $resetPassword;
    }

    public function checkCode(TDO $tdo)
    {
        $resetPassword = ResetPassword::query()
            ->where('expired_at', '>', now())
            ->where('phone', $tdo->phone)
            ->where('code', $tdo->code)
            ->first();

        if (! $resetPassword) {
            return false;
        }

        // generate unique reset token.
        $resetPassword->token = "{$resetPassword->id}|" . Str::random(24);
        $resetPassword->save();

        return $resetPassword;
    }

    public function reset(Tdo $tdo)
    {
        $resetPassword = ResetPassword::query()
            ->where('expired_at', '>', now())
            ->where('token', $tdo->token)
            ->first();

        if (! $resetPassword) {
            return false;
        }

        $user = $resetPassword->model::firstWhere('phone', $resetPassword->phone);
        $user->password = Hash::make($tdo->password);
        $user->save();

        $resetPassword->expired_at = now();
        $resetPassword->save();

        return $user;
    }
}
