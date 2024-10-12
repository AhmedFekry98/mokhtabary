<?php

namespace App\Features\User\Controllers;

use App\Features\User\Requests\CheckCodeRequest;
use App\Features\User\Requests\ForgetRequest;
use App\Features\User\Requests\ResetPasswordRequest;
use App\Features\User\Services\ResetPasswordService;
use App\Features\User\Transformers\UserResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;


class ResetPasswordController extends Controller
{
    use ApiResponses;

    public function __construct(
        private ResetPasswordService $resetPasswordService
    ) {}

    public function forget(ForgetRequest $request)
    {
        $result = $this->resetPasswordService->forget(TDOFacade::make($request));

        if (! $result) {
            return $this->badResponse(
                message: "invalid forget daa"
            );
        }

        return $this->okResponse(
            message: "send forget code to '{$result->phone}'",
            data: $result->code
        );
    }

    public function checkCode(CheckCodeRequest $request)
    {
        $result = $this->resetPasswordService->checkCode(TDOFacade::make($request));

        if (! $result) {
            return $this->badResponse(
                message: "invalid check otp daa"
            );
        }

        return $this->okResponse(
            message: "The code is valid",
            data: [
                'resetToken' => $result->token
            ]
        );
    }

    public function reset(ResetPasswordRequest $request)
    {
        $user = $this->resetPasswordService->reset(TDOFacade::make($request));

        if (! $user) {
            return $this->badResponse(
                message: "invalid reset daa"
            );
        }

        return $this->okResponse(
            message: "Reset password successfuly",
            data: [
                'token' => $user->createToken('api tokens')->plainTextToken,
                'user'  => UserResource::make($user)
            ]
        );
    }
}
