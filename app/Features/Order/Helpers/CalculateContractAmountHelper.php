<?php


namespace App\Features\Order\Helpers;
use App\Features\Order\Services\OrderService;
use App\Features\Payment\Services\LabRadiologyPaymentService;
use App\Features\User\Services\AuthService;

class CalculateContractAmountHelper
{
    private $orderService;
    private $labRadiologyPaymentService;
    private $authService;

    public function __construct(
        OrderService $orderService,
        LabRadiologyPaymentService $labRadiologyPaymentService,
        AuthService $authService
    ) {
        $this->orderService = $orderService;
        $this->labRadiologyPaymentService = $labRadiologyPaymentService;
        $this->authService = $authService;
    }

    public function getReceiverPaymentsSummary(string $receiverId)
    {
        try {
            // Get orders with relationships for receiver id and status 'confirmed'
            $orders = $this->orderService->getOrderByStatusAndReceiverId($receiverId, 'confirmed');
            $receiver = $this->authService->getUser($receiverId);
            $role = $receiver->role->name;

            switch ($role) {
                case 'lab':
                    $orders = collect($orders->load('testOrder'));
                    // Calculate lab tests total
                    $contractAmountTotal = $orders->sum(function ($order) {
                    return $order->testOrder->sum(function ($testOrder) {
                        return $testOrder->labTest->contract_price ?? 0;
                         });
                    });
                break;
                case 'radiology':
                    $orders = collect($orders->load('xrayOrder'));
                    // Calculate xray total
                     $contractAmountTotal =  $orders->sum(function ($order) {
                        return $order->xrayOrder->sum(function ($xrayOrder) {
                            return $xrayOrder->radiologyXRay->contract_price ?? 0;
                        });
                    });
                break;
                default:
                break;
            }


        $amountOrderTotal = $orders->sum('amount'); // Calculate total amountOrder $orders

            return [
                'orders' => $orders,
                'contract_amount_total' => $contractAmountTotal ,
                'amount_order_total' =>  $amountOrderTotal,
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }

}
