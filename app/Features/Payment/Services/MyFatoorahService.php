<?php

namespace App\Features\Payment\Services;

use App\Features\Order\Services\OrderService;
use Graphicode\Standard\TDO\TDO;
use App\Features\Payment\Models\MyFatoorah;
use Exception;
use Graphicode\Standard\Facades\TDOFacade;

class MyFatoorahService
{
    public function webhook($request)
    {

        try{
            // data to created
            $createData = $this->callback($request);
            $orderId = $createData['CustomerReference'];

            // create invoice transaction
            $invoiceTransaction = new InvoiceTransactionService();
            $invoiceTransaction->storeInvoiceTransaction(TDOFacade::make($createData));

            // update status order by order_id
            if($createData['transaction_status'] == "SUCCESS"){
                $order = new OrderService();
                $order->updateStatusOrderById($orderId,TDOFacade::make(['status' => 'paid']));
                return true; // success payment
            }
            return false; // faild payment
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    private function callback($request)
    {
        $handleMyFatoorahWebhook = $this->handleMyFatoorahWebhook($request);
        // callback
        return [
            "invoice_id"                         => $handleMyFatoorahWebhook['InvoiceId'],
            "order_id"                           => $handleMyFatoorahWebhook['CustomerReference'],
            "payment_method"                     => $handleMyFatoorahWebhook['PaymentMethod'],
            "date_operation"                     => $handleMyFatoorahWebhook['CreatedDate'],
            "transaction_status"                 => $handleMyFatoorahWebhook['TransactionStatus'],
            "invoice_value_in_base_currency"     => $handleMyFatoorahWebhook['InvoiceValueInBaseCurrency'],
            "base_currency"                      => $handleMyFatoorahWebhook['BaseCurrency'],
            "invoice_value_in_pay_currency"      => $handleMyFatoorahWebhook['InvoiceValueInPayCurrency'],
            "pay_currency"                       => $handleMyFatoorahWebhook['PayCurrency']
        ];
    }

    private function handleMyFatoorahWebhook($request)
    {
        //Validate webhook_secret_key
        // $secretKey = config('features.payment.webhook_secret_key');
        // if (empty($secretKey)) {
        //     return response(null, 404);
        // }
        \Log::info('in method request', ['request' => $request ]);
        \Log::info('in method handleMyFatoorahWebhook', ['handleMyFatoorahWebhook' => 'handleMyFatoorahWebhook']);
        //Validate MyFatoorah-Signature
        $mfSignature = $request->header('MyFatoorah-Signature');
        if (empty($mfSignature)) {
            return response(null, 404);
        }
        \Log::info('scape method mfSignature', ['mfSignature' => $mfSignature ]);
        //Validate input
        $body  = $request->getContent();
        \Log::info('scape method body', ['body' => $body ]);

        $input = json_decode($body, true);
        \Log::info('scape method input', ['input' => $input ]);

        if (empty($input['Data']) || empty($input['EventType']) || $input['EventType'] != 1) {
            return response(null, 404);
        }
        \Log::info('scape method all', ['all' => 'all' ]);



        // call my fatoorah webhook and return data handle webhook myfatoorah her
        return [
            "InvoiceId"                     => 39713900,
            "CustomerReference"             => "1",
            "PaymentMethod"                 => "Apple Pay (mada)",
            "CreatedDate"                   =>"01122024154951",
            "TransactionStatus"             => "SUCCESS",
            "InvoiceValueInBaseCurrency"    => "50",
            "BaseCurrency"                  => "SAR",
            "InvoiceValueInPayCurrency"     => "50",
            "PayCurrency"                   => "SAR"
        ];
    }

}
