<?php

namespace App\Features\Payment\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Payment\Models\Webhook;

class WebhookService
{
    // myfatoorah -  fawry - paymobe
    private $paymentGetway = 'myfatoorah';

    public function PaymentGetway($request)
    {
        $gatewayType  = $this->paymentGetway;

        switch ($gatewayType) {
            case 'myfatoorah':
                $paymentGateway = new MyFatoorahService();
                break;
            case 'fawry':
                $paymentGateway = new FawryService();
                break;
            case 'paymob':
                $paymentGateway = new PaymobService();
                break;
            default:
                return false;
        }
        $handelWebhook = $this->handelWebhook($paymentGateway,$request);
        return $handelWebhook;
    }

    private function handelWebhook($paymentGateway,$request)
    {
        return $paymentGateway->webhook($request);
    }

}
