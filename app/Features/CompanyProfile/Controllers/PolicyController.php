<?php

namespace App\Features\CompanyProfile\Controllers;

use App\Features\CompanyProfile\Requests\StPolicyRequest;
use App\Features\CompanyProfile\Requests\UpPolicyRequest;
use App\Features\CompanyProfile\Services\PolicyService;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private PolicyService $policyService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->policyService->getPolicies();

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StPolicyRequest $request)
    {
        $result = $this->policyService->storePolicy(TDOFacade::make($request));

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->policyService->getPolicyById($id);

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpPolicyRequest $request, string $id)
    {
        $result = $this->policyService->updatePolicyById($id,TDOFacade::make($request));

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->policyService->deletePolicyById($id);

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }
}
