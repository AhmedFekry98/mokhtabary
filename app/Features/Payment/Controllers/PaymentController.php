<?php

namespace App\Features\Payment\Controllers;

use App\Features\Payment\Services\WebhookService;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private WebhookService $webhookService,
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function webhook()
    {
        $result = $this->webhookService->PaymentGetway();

        return $this->okResponse(
            $result,
            "Success api call"
        );

    }


}
