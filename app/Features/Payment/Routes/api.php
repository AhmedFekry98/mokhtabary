<?php

use App\Features\Payment\Controllers\InvoiceController;
use App\Features\Payment\Controllers\InvoiceTransactionController;
use App\Features\Payment\Controllers\LabRadiologyPaymentController;
use App\Features\Payment\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::prefix("lab-radiology-payment")->group(function() {

    Route::get('/', [LabRadiologyPaymentController::class,'index']);
    Route::post('/', [LabRadiologyPaymentController::class,'store']);

});


Route::prefix("invoice-transaction")->group(function() {

    Route::get('/', [InvoiceTransactionController::class,'index'])->middleware(['auth:sanctum' ,'role:admin']);

});


Route::post('webhook/invoice-transaction', [PaymentController::class,'handle']);

Route::post('payment/create', [PaymentController::class,'createInvoices']);
Route::get('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('payment/error', function () {
    return 'Payment Error!';
})->name('payment.error');

