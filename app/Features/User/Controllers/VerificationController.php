<?php

namespace App\Features\User\Controllers;


use App\Features\User\Services\VerificationService;
use Graphicode\Standard\Traits\ApiResponses;


class VerificationController
{
    use ApiResponses;

    public function __construct(
        private VerificationService $verificationService
    ) {}

    public function send()
    {
        $result = $this->verificationService->sendVerificationCode();

        return $this->okResponse(
            message: "Sent code successfuly",
            data: $result
        );

    }

    public function verify(string $code)
    {
        $result = $this->verificationService->verifyUser($code);

        return $this->okResponse(
            message: "User verified phone successfuly",
            data: $result
        );
    }
}
