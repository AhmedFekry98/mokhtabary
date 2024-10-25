<?php

namespace App\Features\Radiology\Controllers;

use App\Features\Radiology\Requests\UpRadiologyRequest;
use App\Features\Radiology\Services\RadiologyService;
use App\Features\Radiology\Transformers\RadiologyCollection;
use App\Features\Radiology\Transformers\RadiologyResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class RadiologyController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private  RadiologyService $radiologyService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->radiologyService->getRadiologies();
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            RadiologyCollection::make($result),
            "Success api call"
        );
    }


    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->radiologyService->getRadiologyById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            RadiologyResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpRadiologyRequest $request, string $id)
    {
        $result = $this->radiologyService->updateRadiologyById($id,TDOFacade::make($request));
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            RadiologyResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->radiologyService->deleteRadiologyById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            RadiologyResource::make($result),
            "Success api call"
        );
    }
}
