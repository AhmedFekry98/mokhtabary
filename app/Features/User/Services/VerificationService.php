<?php

namespace App\Features\User\Services;

use App\Features\Auth\Models\VerificationCode;
use App\Features\SmsGetway\Services\WhySmsGetwayService;

class VerificationService
{
    public function __construct(
        private WhySmsGetwayService $whySmsGetwayService
    ) {}

    public function sendVerificationCode()
    {
        $user = auth()->user();

        if ($user->phone_verified_at != null) {
            return 'User phone number already verified';
        }

        // to waiting the 5mins and send agin
        $validCodes = $user->verificationCodes()
            ->where('expired_at', '>', now())
            ->count();

            if ($validCodes > 0) {
                return 'plese waiting the 5mins and try agin';
            }

        $verificationCode = $user->createVerificationCode(now()->addMinute(5));

        // send the whatsapp message.
        $isSent = $this->whySmsGetwayService->sendMessage(
            to: $user->phone,
            message: "Your verification code is {$verificationCode->code}"
        );

        return $isSent;
    }


    public function verifyUser(string $code)
    {
        $user = auth()->user();

        $verificationCode = $user->verificationCodes()
            ->where('expired_at', '>', now())
            ->where('code', $code);


        $development = config('app.env') != 'production' && $code == '0000';

        if (! $verificationCode && ! $development) {
            return 'Invalid verification code';
        }


        if ($user->phone_verified_at != null) {
            return 'User phone number already verified';
        }

        $user->phone_verified_at = now();
        $user->save();

        return $user;
    }
}
