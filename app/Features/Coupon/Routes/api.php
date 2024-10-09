<?php

use App\Features\Coupon\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

Route::prefix("coupons")->group(function() {

    Route::get('/', [CouponController::class,'index']);
    Route::post('/', [CouponController::class,'store']);
    Route::get('/{id}', [CouponController::class,'show']);
    Route::get('code/{code}', [CouponController::class,'getCouponByCode']);
    Route::put('/status/{id}', [CouponController::class,'updateStatusCouponById']);
    Route::delete('/{id}', [CouponController::class,'destroy']);

});