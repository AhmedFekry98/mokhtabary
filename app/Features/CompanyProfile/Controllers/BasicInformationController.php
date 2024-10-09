<?php

namespace App\Features\CompanyProfile\Controllers;

use App\Features\CompanyProfile\Requests\UpBasicInformationRquest;
use App\Features\CompanyProfile\Services\BasicInformationService;
use App\Features\CompanyProfile\Transformers\BasicInformationResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class BasicInformationController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private BasicInformationService $basicInformationService
    ) {}

  
    /**
        * Display the specified resource.
        */
    public function show()
    {
        $result = $this->basicInformationService->getBasicInformationById();

        return $this->okResponse(
            BasicInformationResource::make($result) ,
            "Success api call"
        );
    }

    /**
        * Update the specified resource in storage.
        */
    public function updateOrCreate(UpBasicInformationRquest $request)
    {
        $result = $this->basicInformationService->updateOrCreateBasicInformation(TDOFacade::make($request));

        return $this->okResponse(
            BasicInformationResource::make($result),
            "Success api call"
        );
    }

}
