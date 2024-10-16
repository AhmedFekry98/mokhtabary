<?php

namespace App\Features\Packages\Controllers;

use App\Features\Packages\Requests\StPackageRequest;
use App\Features\Packages\Services\PackageService;
use App\Features\Packages\Transformers\PackageResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private PackageService $packageService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->packageService->getPackages();

        return $this->okResponse(
            PackageResource::collection($result),
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StPackageRequest $request)
    {
        $result = $this->packageService->storePackage(TDOFacade::make($request));

        return $this->okResponse(
            PackageResource::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->packageService->getPackageById($id);

        return $this->okResponse(
            PackageResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->packageService->deletePackageById($id);

        return $this->okResponse(
            PackageResource::make($result),
            "Success api call"
        );
    }

}
