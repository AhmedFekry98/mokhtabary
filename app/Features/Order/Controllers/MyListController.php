<?php

namespace App\Features\Order\Controllers;

use App\Features\Order\Services\OrderService;
use App\Features\Order\Services\PrescriptionOrderService;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;

class MyListController extends Controller
{
    use ApiResponses;

    public function __construct(
        private OrderService $orderService,
        private PrescriptionOrderService $prescriptionOrderService
    ) {}

    public function index()
    {
        $orderCount = $this->orderService->getOrdersCount();
        $prescriptionOrderCount = $this->prescriptionOrderService->getPrescriptionOrdersCount();

        return $this->okResponse(
            data: [
                'order' => $orderCount,
                'prescription_order' => $prescriptionOrderCount
            ],
            message: "Success api call"
        );
    }
}
