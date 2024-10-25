<?php

namespace App\Features\CompanyProfile\Controllers;

use App\Features\CompanyProfile\Requests\StPartnerRequest;
use App\Features\CompanyProfile\Services\PartnerService;
use App\Features\CompanyProfile\Transformers\PartnerResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private PartnerService $partnerService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->partnerService->getPartners();

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
           PartnerResource::collection($result),
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StPartnerRequest $request)
    {
        $result = $this->partnerService->storePartner(TDOFacade::make($request));
        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            PartnerResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->partnerService->deletePartnerById($id);

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }
}
