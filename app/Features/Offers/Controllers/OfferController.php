<?php

namespace App\Features\Offers\Controllers;

use App\Features\Offers\Requests\StOfferRequest;
use App\Features\Offers\Services\OfferService;
use App\Features\Offers\Transformers\OfferResource;
use App\Features\Order\Requests\StOrderRequest;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private OfferService $offerService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->offerService->getOffers();

        return $this->okResponse(
            OfferResource::collection($result),
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StOfferRequest $request)
    {
        $result = $this->offerService->storeOffer(TDOFacade::make($request));

        return $this->okResponse(
            OfferResource::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->offerService->getOfferById($id);

        return $this->okResponse(
            OfferResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->offerService->deleteOfferById($id);

        return $this->okResponse(
            OfferResource::make($result),
            "Success api call"
        );
    }
}
