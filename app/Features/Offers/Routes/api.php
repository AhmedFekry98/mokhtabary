<?php

use App\Features\Offers\Controllers\OfferController;
use Illuminate\Support\Facades\Route;




Route::prefix("offers")->group(function() {

    Route::get('/', [OfferController::class,'index']);
    Route::post('/', [OfferController::class,'store']);
    Route::get('/{id}', [OfferController::class,'show']);
    Route::delete('/{id}', [OfferController::class,'destroy']);

});
