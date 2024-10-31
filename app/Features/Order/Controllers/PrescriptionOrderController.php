<?php

namespace App\Features\Order\Controllers;

use App\Features\Order\Requests\StPrescriptionOrderRequest;
use App\Features\Order\Services\PrescriptionOrderService;
use App\Features\Order\Transformers\PrescriptionOrderResource;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PrescriptionOrderController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private PrescriptionOrderService $prescriptionOrderService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->prescriptionOrderService->getPrescriptionOrders();

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            PrescriptionOrderResource::collection($result),
            "Success api call"
        );
    }

    /**
        * Store a newly created resource in storage.
        */
    public function store(StPrescriptionOrderRequest $request)
    {
        $result = $this->prescriptionOrderService->storePrescriptionOrder(TDOFacade::make($request));

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            PrescriptionOrderResource::make($result),
            "Success api call"
        );
    }

    /**
        * Display the specified resource.
        */
    public function show(string $id)
    {
        $result = $this->prescriptionOrderService->getPrescriptionOrderById($id);

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            PrescriptionOrderResource::make($result),
            "Success api call"
        );
    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(string $id)
    {
        $result = $this->prescriptionOrderService->deletePrescriptionOrderById($id);

        if (is_string($result)) {
            return $this->badResponse(
                message: $result
            );
        }

        return $this->okResponse(
            PrescriptionOrderResource::make($result),
            "Success api call"
        );
    }
}
