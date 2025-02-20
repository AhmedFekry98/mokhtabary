<?php

namespace App\Features\Lab\Controllers;

use App\Features\Lab\Models\LabTest;
use App\Features\Lab\Models\Test;
use App\Features\Lab\Requests\StTestRequest;
use App\Features\Lab\Requests\UpTestRequest;
use App\Features\Lab\Services\TestService;
use App\Features\Lab\Transformers\TestCollection;
use Graphicode\Standard\Facades\TDOFacade;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Graphicode\Standard\Traits\ApiResponses;

class TestController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private TestService $testService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->testService->getTests();
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            TestCollection::make($result),
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StTestRequest $request)
    {
        $result = $this->testService->storeTest(TDOFacade::make($request));
        if(is_string($result)){
            return $this->badResponse($result);
        }
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
        $result = $this->testService->getTestById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpTestRequest $request, string $id)
    {
        $result = $this->testService->updateTestById($id,TDOFacade::make($request));
        if(is_string($result)){
            return $this->badResponse($result);
        }
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
        $result = $this->testService->deleteTestById($id);
        if(is_string($result)){
            return $this->badResponse($result);
        }
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }












}
