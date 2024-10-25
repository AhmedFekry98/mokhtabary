<?php

namespace App\Features\Lab\Controllers;

use App\Features\Lab\Requests\UOCLabTestRequest;
use App\Features\Lab\Services\LabTestService;
use App\Features\Lab\Transformers\LabTestCollection;
use App\Features\Lab\Transformers\LabTestResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private LabTestService $labTestService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index($labId)
    {
        $result = $this->labTestService->getLabTests($labId);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            LabTestCollection::make($result['tests'])->additional(['lab_info' => $result['lab_info']]), // Pass lab info as additional data
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function UpdateOrCreate(UOCLabTestRequest $request)
    {
        $result = $this->labTestService->updateOrCreateLabTest(TDOFacade::make($request));
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            LabTestResource::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {

        $result = $this->labTestService->getLabTestById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            LabTestResource::make($result),
            "Success api call"
        );
    }




}
