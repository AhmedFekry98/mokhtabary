<?php

namespace App\Features\CompanyProfile\Controllers;

use App\Features\CompanyProfile\Requests\StTermConditionRequest;
use App\Features\CompanyProfile\Requests\UpTermConditionRequest;
use App\Features\CompanyProfile\Services\TermConditionService;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private TermConditionService $termConditionService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->termConditionService->getTermConditions();

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StTermConditionRequest $request)
    {
        $result = $this->termConditionService->storeTermCondition(TDOFacade::make($request));

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
        $result = $this->termConditionService->getTermConditionById($id);

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpTermConditionRequest $request, string $id)
    {
        $result = $this->termConditionService->updateTermConditionById($id,TDOFacade::make($request));

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
        $result = $this->termConditionService->deleteTermConditionById($id);

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }
}
