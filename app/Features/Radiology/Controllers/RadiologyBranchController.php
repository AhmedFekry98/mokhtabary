<?php

namespace App\Features\Radiology\Controllers;

use App\Features\Radiology\Requests\UpRadiologyBranchRequest;
use App\Features\Radiology\Services\RadiologyBranchService;
use App\Features\Radiology\Transformers\RadiologyBranchResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class RadiologyBranchController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private RadiologyBranchService $radiologyBranchService
    ) {}



    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->radiologyBranchService->getRadiologyBranchById($id);

        return $this->okResponse(
            RadiologyBranchResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpRadiologyBranchRequest $request, string $id)
    {
        $result = $this->radiologyBranchService->updateRadiologyBranchById($id,TDOFacade::make($request));

        return $this->okResponse(
            RadiologyBranchResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->radiologyBranchService->deleteRadiologyBranchById($id);

        return $this->okResponse(
            RadiologyBranchResource::make($result),
            "Success api call"
        );
    }
}
