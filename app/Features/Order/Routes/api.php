<?php

use App\Features\Order\Controllers\OrderController;
use App\Features\Order\Controllers\PrescriptionOrderController;
use App\Features\Order\Controllers\MyListController; // added this line
use Illuminate\Support\Facades\Route;

Route::prefix("orders")->group(function() {

    Route::get('/', [OrderController::class,'index'])->middleware(['auth:sanctum']);
    Route::get('/{id}', [OrderController::class,'show']);
    Route::post('/', [OrderController::class,'store'])->middleware(['auth:sanctum','role:client']);
    Route::put('/{id}', [OrderController::class,'update']);
    Route::delete('/{id}', [OrderController::class,'destroy']);

});



Route::prefix("prescription-order")->group(function() {

    Route::get('/', [PrescriptionOrderController::class,'index'])->middleware(['auth:sanctum']);
    Route::get('/{id}', [PrescriptionOrderController::class,'show']);
    Route::post('/', [PrescriptionOrderController::class,'store'])->middleware(['auth:sanctum','role:client']);
    Route::delete('/{id}', [PrescriptionOrderController::class,'destroy']);

});


Route::prefix("mylist-count")->group(function() {

    Route::get('/', [MyListController::class,'index'])->middleware(['auth:sanctum']);

});
