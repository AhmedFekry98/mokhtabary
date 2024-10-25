<?php

namespace App\Features\Client\Controllers;

use App\Features\Client\Requests\UpFamilyRequest;
use App\Features\Client\Services\FamilyService;
use App\Features\Client\Transformers\FamilyResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private FamilyService $familyService
    ) {}


    public function show( string $id)
    {
        $result = $this->familyService->getFamilyById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            FamilyResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpFamilyRequest $request, string $id)
    {
        $result = $this->familyService->updateFamilyById($id,TDOFacade::make($request));
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            FamilyResource::make($result),
            "Success api call"
        );
    }


    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->familyService->deleteFamilyById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            FamilyResource::make($result),
            "Success api call"
        );
    }
}
