<?php

namespace App\Features\User\Controllers;

use App\Features\User\Requests\RegisterRequest;
use App\Features\User\Services\RegisterService;
use App\Features\User\Transformers\UserResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private RegisterService $registerService
    ) {}

    public function register(RegisterRequest $request , $guard)
    {

        $result = $this->registerService->register(TDOFacade::make($request),$guard);

        if(is_string($result)){
            return $this->badResponse($result);
        }

        $tokenName = $request->userAgent() . ' - ' . $request->ip();
        $token = $result->createToken($tokenName);

        return $this->okResponse(
            data:[
                'token' => $token->plainTextToken,
                'result' => UserResource::make($result)
            ],

            message: "successfully registeretion",
        );

    }



}
