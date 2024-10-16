<?php

use App\Features\Order\Controllers\OrderController;
use App\Features\Order\Controllers\PrescriptionOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix("orders")->group(function() {

    Route::get('/', [OrderController::class,'index']);
    Route::get('/{id}', [OrderController::class,'show']);
    Route::post('/', [OrderController::class,'store'])->middleware('auth:sanctum');
    Route::put('/{id}', [OrderController::class,'update']);
    Route::delete('/{id}', [OrderController::class,'destroy']);

});

// Route::prefix("prescription-order")->group(function() {

//     Route::get('/', [PrescriptionOrderController::class,'index']);
//     Route::get('/{id}', [PrescriptionOrderController::class,'show']);
//     Route::post('/', [PrescriptionOrderController::class,'store']);
//     Route::delete('/{id}', [PrescriptionOrderController::class,'destroy']);

// });
