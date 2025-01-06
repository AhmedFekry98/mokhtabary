<?php


public function webhook(Request $request) {
    $payload = $request->json()->all();
    $record = PaymentWebhook::where('payment_id', $payload['Data']['PaymentId'])
                                    ->where('invoice_id', $payload['Data']['InvoiceId'])
                                    ->first();
    if(isset($payload['Data']['TransactionStatus']) && $payload['Data']['TransactionStatus'] == 'SUCCESS') {
        $record->update([
            'status' => 'SUCCESS',
            'notes' => 'Payment Success'
        ]);
        $this->CreateOrder(
            serviceId: $record->service_id,
            paymentMethod: 'card',
            paymentID: $record->payment_id
        );
    } else {
        $record->update([
            'status' => isset($payload['Data']['TransactionStatus']) ? $payload['Data']['TransactionStatus'] : 'FAILED',
        ]);
    }
}

public function callback(Request $request) {
    $data = $request->validate([
        'paymentId' => 'required|string|exists:payment_webhooks,payment_id',
    ]);
    try{
        $myFatoorah = new MyFatoorah;
        $response = $myFatoorah->callback($data['paymentId']);
        if(array_key_exists('Data', $response) && $response['Data']['InvoiceStatus'] == 'Paid') {
            $paymentWebohook = PaymentWebhook::where('payment_id', $data['paymentId'])->first();
            if($paymentWebohook && $paymentWebohook->status == 'PENDING') {
                $paymentWebohook->update([
                    'status' => 'SUCCESS',
                    'notes' => 'Payment Success'
                ]);
                $this->CreateOrder(
                    serviceId: $paymentWebohook->service_id,
                    paymentMethod: 'card',
                    paymentID: $paymentWebohook->payment_id
                );
            }
            return ApiHelper::respondOk(['success' => true]);
        } else {
            return ApiHelper::respondInternalError(['success' => false]);
        }
    } catch(Exception $e){
        return ApiHelper::respondInternalError($e->getMessage());
    }
}