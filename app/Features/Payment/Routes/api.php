<?php

use App\Features\Payment\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Route::prefix("payments")->group(function() {

//     Route::apiResource('/', MayController::class);

// });


Route::post('webhook/invoice-transaction', [PaymentController::class,'webhook']);
