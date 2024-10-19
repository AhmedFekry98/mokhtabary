<?php

namespace App\Features\Lab\Controllers;

use App\Features\Lab\Requests\UpLabBranchRequest;
use App\Features\Lab\Services\LabBranchService;
use App\Features\Lab\Transformers\LabBranchResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LabBranchController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private LabBranchService $labBranchService
    ) {}


    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->labBranchService->getLabBranchById($id);

        return $this->okResponse(
            LabBranchResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpLabBranchRequest $request, string $id)
    {
        $result = $this->labBranchService->updateLabById($id,TDOFacade::make($request));

        return $this->okResponse(
            LabBranchResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->labBranchService->deleteLabBranchById($id);

        return $this->okResponse(
            LabBranchResource::make($result),
            "Success api call"
        );
    }
}
