<?php

namespace App\Features\Payment\Controllers;

use App\Features\Payment\Services\WebhookService;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    use ApiResponses;


    protected $apiKey;
    protected $baseUrl;
    /**
        * Inject your service in constructor
        */
    public function __construct(
        private WebhookService $webhookService,
    ) {
        $this->apiKey = env('MY_FATOORAH_API_KEY');
        $this->baseUrl = env('MY_FATOORAH_BASE_URL');
    }

    /**
        * Display a listing of the resource.
        */
    public function handle(Request $request)
    {


        $result = $this->webhookService->PaymentGetway($request->all());
        return $this->okResponse(
            $result,
            "Success api call"
        );

    }

    private function request($endpoint, $method = 'POST', $data = [])
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

    public function createInvoice($data)
    {
        return $this->request('v2/SendPayment', 'POST', $data);
    }

    public function getPaymentStatus($paymentId)
    {
        return $this->request('v2/getPaymentStatus', 'POST', ['Key' => $paymentId, 'KeyType' => 'InvoiceId']);
    }

    public function createInvoices(Request $request)
    {
        $data = [
            'CustomerName' => 'ahmed',
            'NotificationOption' => 'ALL',
            'InvoiceValue' =>"2000",
            'CustomerMobile' =>"0111111111",
            'CustomerEmail' => "oT8oP@example.com",
            // 'CallBackUrl' =>'www.google.com',
            // 'ErrorUrl' => 'www.google.com',
            'CallBackUrl' => route('payment.callback'),
            'ErrorUrl' => route('payment.error'),
        ];

        try {
            $response = $this->createInvoice($data);

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function callback(Request $request)
    {
        $paymentId = $request->paymentId;

        try {
            $response = $this->getPaymentStatus($paymentId);
            return response()->json($response);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
