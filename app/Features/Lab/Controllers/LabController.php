<?php

namespace App\Features\Lab\Controllers;

use App\Features\Lab\Requests\UpLabRequest;
use App\Features\Lab\Services\LabService;
use App\Features\Lab\Transformers\LabCollection;
use App\Features\Lab\Transformers\LabResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LabController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private LabService $labService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->labService->getLabs();
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            LabCollection::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->labService->getLabById($id);

        if (is_string($result)) {
            return $this->badResponse($result);
        }

        return $this->okResponse(
            LabResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpLabRequest $request, string $id)
    {
        $result = $this->labService->updateLabById($id,TDOFacade::make($request));
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            LabResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->labService->deleteLabById($id);

        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            LabResource::make($result),
            "Success api call"
        );
    }
}
