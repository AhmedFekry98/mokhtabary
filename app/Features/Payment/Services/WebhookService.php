<?php

namespace App\Features\Payment\Services;

use Graphicode\Standard\TDO\TDO;
use App\Features\Payment\Models\Webhook;

class WebhookService
{
    // myfatoorah -  fawry - paymobe
    private $paymentGetway = 'myfatoorah';

    public function PaymentGetway()
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
        $handelWebhook = $this->handelWebhook($paymentGateway);
        return $handelWebhook;
    }

    private function handelWebhook($paymentGateway)
    {
        return $paymentGateway->webhook();
    }

}
