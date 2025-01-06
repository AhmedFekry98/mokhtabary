<?php

namespace App\Features\Ledger\Controllers;

use App\Features\Order\Helpers\CalculateContractAmountHelper;
use App\Features\Payment\Models\LabRadiologyPayment;
use App\Features\Payment\Services\LabRadiologyPaymentService;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private LabRadiologyPaymentService $labRadiologyPaymentService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function show(string $id)
    {

        // order amount - many must pay for receiver
        $helperContractAmount = new CalculateContractAmountHelper(
            new \App\Features\Order\Services\OrderService(),
            new \App\Features\Payment\Services\LabRadiologyPaymentService(),
            new \App\Features\User\Services\AuthService()
        );

        // get receiver payments summary (allAmountForReceiver)
        $allAmountForReceiver = $helperContractAmount->getReceiverPaymentsSummary($id);

        //  all amount paid for receiver
        $allPaidAmountForReceiver = $this->labRadiologyPaymentService->getLabRadiologyPaymentByReceiverId($id);

        $result = [
            'credit' => $allAmountForReceiver,
            'debit' => $allPaidAmountForReceiver
        ];


        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

}
