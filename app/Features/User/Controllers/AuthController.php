<?php

namespace App\Features\User\Controllers;

use App\Features\User\Requests\ChangePasswordRequest;
use App\Features\User\Requests\LoginRequest;
use App\Features\User\Requests\UpProfileRequest;
use App\Features\User\Services\AuthService;
use App\Features\User\Transformers\UserResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login(TDOFacade::make($request));

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        $user  = $result;
        $tokenName = $request->userAgent() . ' - ' . $request->ip();
        $token = $user->createToken($tokenName);


        return $this->okResponse(
            message: "Authenticate user successfuly.",
            data: [
                'token'     => $token->plainTextToken,
                'result'    => UserResource::make($result)
                // 'role'      => $user->role_name,
                // 'abilities' => $user->abilities,
            ]
        );
    }

    public function logout()
    {

        $result = $this->authService->logout();

        return $this->okResponse(
            $result,
            "Destroy token successfuly."
        );
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        $result = $this->authService->changePassword(TDOFacade::make($request));

        return $this->okResponse(
            message: "Changed password successfuly.",
            data: $result
        );

    }

    public function profile()
    {
        $result =$this->authService->getAuthUser();
        return $this->okResponse(
            message: "Changed password successfuly.",
            data: UserResource::make($result)
        );
    }

    public function updateprofile(UpProfileRequest $request)
    {
        $result = $this->authService->updateProfile(TDOFacade::make($request));

        return $this->okResponse(
            message: "Changed password successfuly.",
            data:UserResource::make($result)
        );
    }

}
