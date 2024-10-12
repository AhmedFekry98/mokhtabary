<?php

namespace App\Features\SmsGetway\Services;

use Illuminate\Support\Facades\Http;

class WhySmsGetwayService
{
    protected $url = "https://bulk.whysms.com/api/v3/sms/send";

    protected $appKey = null;

    protected $authKey = null;

    protected $type = "plain";

    protected $senderId = "Mokhtabary";

    protected $cuntryCode = "20";

    public function __construct()
    {
        $this->authKey = config('features.sms_getway.auth_key');
    }


    public function sendMessage(string $to, $message)
    {
        $recipient = $this->cuntryCode . ltrim($to, '0');

        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            'Authorization' =>"Bearer $this->authKey",
        ])->post($this->url, [
            'recipient' => $recipient ,
            'sender_id' => $this->senderId,
            'type'      => $this->type,
            'message'   => $message
        ]);     

        if ($response->ok()) {
            $decodedResponse = json_decode($response->body(), true);
            return $decodedResponse['data'] ?? null;
        }

        return false;
        
    }
}
