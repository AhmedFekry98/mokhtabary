<?php

namespace App\Features\Payment\Controllers;

use App\Features\Order\Helpers\CalculateContractAmountHelper;
use App\Features\Payment\Requests\StLabRadiologyPaymentRequest;
use App\Features\Payment\Services\LabRadiologyPaymentService;
use Graphicode\Standard\Facades\TDOFacade;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LabRadiologyPaymentController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private LabRadiologyPaymentService $labRadiologyPaymentService
    ) {}


    /**
        * Store a newly created resource in storage.
        */
    public function index()
    {
        $helper = new CalculateContractAmountHelper(
            new \App\Features\Order\Services\OrderService(),
            new \App\Features\Payment\Services\LabRadiologyPaymentService(),
            new \App\Features\User\Services\AuthService()
        );

        $result = $helper->getReceiverPaymentsSummary('2');

        return $this->okResponse(
            $result,
            "Success api call"
        );
    }
    public function store(StLabRadiologyPaymentRequest $request)
    {
        $result = $this->labRadiologyPaymentService->storeLabRadiologyPayment(TDOFacade::make($request));

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
