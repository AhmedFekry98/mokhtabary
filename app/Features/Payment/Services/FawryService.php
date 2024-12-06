<?php

namespace App\Features\Payment\Services;

use App\Features\Order\Services\OrderService;
use Graphicode\Standard\TDO\TDO;
use App\Features\Payment\Models\Fawry;
use Exception;
use Graphicode\Standard\Facades\TDOFacade;

class FawryService
{
    public function webhook()
    {
        try{
            $orderId = 1;

            $createData = $this->callback();

            // create invoice transaction
            $invoiceTransaction = new InvoiceTransactionService();
            $invoiceTransaction->storeInvoiceTransaction(TDOFacade::make($createData));

            // update status order by order_id
            $order = new OrderService();
            $order->UpdateStatusOrderById($orderId,TDOFacade::make());

        }catch(Exception $e){
            return $e->getMessage();
        }


        return "webhook myfatoorah";
    }

    private function callback()
    {
        // callback
        return [
            "invoice_id"                         => null    ,
            "order_id"                           => null    ,
            "payment_method"                     => null    ,
            "date_operation"                     => null    ,
            "transaction_status"                 => null    ,
            "invoice_value_in_base_currency"     => null    ,
            "base_currency"                      => null    ,
            "invoice_value_in_pay_currency"    => null    ,
            "pay_currency"                       => null
        ];
    }
}
