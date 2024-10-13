<?php

namespace App\Features\Radiology\Controllers;

use App\Features\Radiology\Requests\StxRayRequest;
use App\Features\Radiology\Requests\UpxRayRequest;
use App\Features\Radiology\Services\XRayService;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class XRayController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private XRayService $xRayService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->xRayService->getXRays();
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StxRayRequest $request)
    {
        $result = $this->xRayService->storeXRay(TDOFacade::make($request));
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
        $result = $this->xRayService->getXRayById($id);
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function update(UpxRayRequest $request, string $id)
    {
        $result = $this->xRayService->updateXRayById($id,TDOFacade::make($request));
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
        $result = $this->xRayService->deleteXRayById($id);
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }
}
