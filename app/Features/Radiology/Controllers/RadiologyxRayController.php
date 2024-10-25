<?php

namespace App\Features\Radiology\Controllers;

use App\Features\Radiology\Requests\UOCRadiologyxRayRequest;
use App\Features\Radiology\Services\RadiologyxRayService;
use App\Features\Radiology\Transformers\RadiologyxRayCollection;
use App\Features\Radiology\Transformers\RadiologyxRayResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class RadiologyxRayController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
        public function __construct(
            private RadiologyxRayService $radiologyxRayService
        ) {}

        /**
            * Display a listing of the resource.
            */
        public function index($labId)
        {
            $result = $this->radiologyxRayService->getRadiologyXrays($labId);

            if(is_string($result)){
                return $this->badResponse($result);
            }
            return $this->okResponse(
                RadiologyxRayCollection::make($result['xray'])->additional(['radiology_info' => $result['radiology_info']]), // Pass lab info as additional data
                "Success api call"
            );
        }

        /**
            * Store a newly created resource in storage.
            */
        public function UpdateOrCreate(UOCRadiologyxRayRequest $request)
        {
            $result = $this->radiologyxRayService->updateOrCreateRadiologyXray(TDOFacade::make($request));
            if(is_string($result)){
                return $this->badResponse($result);
            }
            return $this->okResponse(
                RadiologyxRayResource::make($result),
                "Success api call"
            );
        }

        /**
            * Display the specified resource.
            */
        public function show(string $id)
        {

            $result = $this->radiologyxRayService->getRadiologyXrayById($id);
            if(is_string($result)){
                return $this->badResponse($result);
            }
            return $this->okResponse(
                RadiologyxRayResource::make($result),
                "Success api call"
            );
        }

}
