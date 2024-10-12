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

     // Prepare the response data
        $data = [
            'result' => $result
        ];


        // Check if the guard is 'family' and add the token if true
        if ($guard != 'family') {
            $tokenName = $request->userAgent() . ' - ' . $request->ip();
            $token = $result->createToken($tokenName);
            $data['token'] =$token->plainTextToken;
        }

        $responseData = [
            'result' => UserResource::make($data['result']),
        ];
        $responseData['token'] = $data['token'];

        return $this->okResponse(
            data:$responseData,
            message: "successfully registeretion",
        );

    }


    
}
