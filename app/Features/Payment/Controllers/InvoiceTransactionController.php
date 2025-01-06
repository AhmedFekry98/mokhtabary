<?php

namespace App\Features\Payment\Controllers;

use App\Features\Payment\Services\InvoiceTransactionService;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class InvoiceTransactionController extends Controller
{
    use ApiResponses;


    /**
        * Inject your service in constructor
        */
    public function __construct(
        private InvoiceTransactionService $invoiceTransactionService
    ) {}

    /**
        * Display a listing of the resource.
        */
    public function index()
    {
        $result = $this->invoiceTransactionService->getInvoiceTransactions();
        // make sum fron client sid
        return $this->okResponse(
            $result,
            "Success api call"
        );
    }

}
