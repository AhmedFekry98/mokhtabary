<?php

namespace App\Features\CompanyProfile\Controllers;

use App\Features\CompanyProfile\Requests\StGovernorateRequest;
use App\Features\CompanyProfile\Requests\UpGovernorateRequest;
use App\Features\CompanyProfile\Services\GovernorateService;
use App\Features\CompanyProfile\Transformers\GovernorateCollection;
use App\Features\CompanyProfile\Transformers\GovernorateResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        Private GovernorateService $governorateService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->governorateService->getGovernorates();

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            GovernorateCollection::make($result) ,
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StGovernorateRequest $request)
    {
        $result = $this->governorateService->storeGovernorate(TDOFacade::make($request));

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            GovernorateResource::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->governorateService->getGovernorateById($id);

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            GovernorateResource::make($result),
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpGovernorateRequest $request, string $id)
    {
        $result = $this->governorateService->updateGovernorateById($id,TDOFacade::make($request));

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            GovernorateResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->governorateService->deleteGovernorateById($id);

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            GovernorateResource::make($result),
            "Success api call"
        );
    }
}
