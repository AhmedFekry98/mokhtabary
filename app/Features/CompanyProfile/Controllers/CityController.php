<?php

namespace App\Features\CompanyProfile\Controllers;

use App\Features\CompanyProfile\Requests\StCityRequest;
use App\Features\CompanyProfile\Services\CityService;
use App\Features\CompanyProfile\Transformers\CityResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private CityService $cityService
    ) {}

    /**
        * Display a listing of the resource.
        */
    // public function index()
    // {
    //     $result = null;

    //     if (is_string($result)) {
    //         return $this->badResponse(
    //             message: $result
    //         );
    //     }

    //     return $this->okResponse(
    //         $result,
    //         "Success api call"
    //     );
    // }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StCityRequest $request)
    {
        $result = $this->cityService->storeCity(TDOFacade::make($request));

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            CityResource::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    // public function show(string $id)
    // {
    //     $result = null;

    //     if (is_string($result)) {
    //         return $this->badResponse(
    //             message: $result
    //         );
    //     }

    //     return $this->okResponse(
    //         $result,
    //         "Success api call"
    //     );
    // }

    /**
        * Update the specified resource in storage.
        */
    // public function update(Request $request, string $id)
    // {
    //     $result = null;

    //     if (is_string($result)) {
    //         return $this->badResponse(
    //             message: $result
    //         );
    //     }

    //     return $this->okResponse(
    //         $result,
    //         "Success api call"
    //     );
    // }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->cityService->deleteCityById($id);

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            CityResource::make($result),
            "Success api call"
        );
    }
}
