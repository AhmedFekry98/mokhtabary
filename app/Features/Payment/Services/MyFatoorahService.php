<?php

namespace App\Features\Payment\Services;

use App\Features\Order\Services\OrderService;
use Graphicode\Standard\TDO\TDO;
use App\Features\Payment\Models\MyFatoorah;
use Exception;
use Graphicode\Standard\Facades\TDOFacade;
use Illuminate\Support\Facades\Http;

class MyFatoorahService
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('MY_FATOORAH_API_KEY');
        $this->baseUrl = env('MY_FATOORAH_BASE_URL');
    }

    public function webhook()
    {

        try{
            // data to created
            $createData = $this->callback();

            $orderId = $createData['order_id'];
            // create invoice transaction
            $invoiceTransaction = new InvoiceTransactionService();
            $invoiceTransaction->storeInvoiceTransaction(TDOFacade::make($createData));

            // update status order by order_id
            if($createData['transaction_status'] == "Succss"){
                $order = new OrderService();
                $order->updateStatusOrderById($orderId,TDOFacade::make(['status' => 'paid']));
                return true; // success payment
            }
            return false; // faild payment
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    private function callback()
    {
        $handleMyFatoorahWebhook = $this->handleMyFatoorahWebhook();
        // callback
        return [
            'order_id'              => $handleMyFatoorahWebhook['Data']['CustomerReference'],
            'payment_id'            => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['PaymentId'] ?? null,
            'payment_gateway'       => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['PaymentGateway'] ?? null,
            'transaction_date'      => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['TransactionDate'] ?? null,
            'transaction_status'    => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['TransactionStatus'] ?? null,
            'total_service_charge'  => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['TotalServiceCharge'] ?? null,
            'due_value'             => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['DueValue'] ?? null,
            'paid_currency'         => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['PaidCurrency'] ?? null,
            'paid_currency_value'   => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['PaidCurrencyValue'] ?? null,
            'vat_amount'            => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['VatAmount'] ?? null,
            'currency'              => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['Currency'] ?? null,
            'error'                 => $handleMyFatoorahWebhook['Data']['InvoiceTransactions'][0]['Error'] ?? null,
        ];
    }

    // call my fatoorah webhook and return data handle webhook myfatoorah her
    private function handleMyFatoorahWebhook()
    {

        //Validate webhook_secret_key
        $secretKey = "ZhmU5HLe1/7S1zzBcBGckazMCQ1NL0DzxSpUlFHd+QgEZx+1VLH0vBW4wVhTF2dtnhXWVAea8kIGHjhyFAAYmg==";
        if (empty($secretKey)) {
            return response(null, 404);
        }
        $request = request();

        //Validate input
        $body  = $request->getContent();

        $input = json_decode($body, true);

        if (empty($input['Data']) || empty($input['EventType']) || $input['EventType'] != 1) {
            return response(null, 404);
        }

        \Log::info('scape method input', ['input' => $input ]);

        $paymentId = $input['Data']['PaymentId'];
        $paymentStatus = $this->getPaymentStatus($paymentId);

        \Log::info('payment status : ', ['paymentId' => $paymentId, 'paymentStatus' => $paymentStatus]);

        return $paymentStatus;

    }

    private function MyafatoorahRequest($endpoint, $method = 'POST', $data = [])
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
            ])->{$method}("{$this->baseUrl}/$endpoint", $data);

            // dd($response);
        if ($response->failed()) {
            throw new \Exception($response->body());
        }

        return $response->json();
    }

    private function getPaymentStatus($paymentId)
    {
        return $this->MyafatoorahRequest('v2/getPaymentStatus', 'POST', ['Key' => $paymentId, 'KeyType' => 'PaymentId']);
    }

}
