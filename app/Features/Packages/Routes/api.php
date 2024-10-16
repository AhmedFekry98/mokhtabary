<?php

use App\Features\Packages\Controllers\PackageController;
use Illuminate\Support\Facades\Route;




Route::prefix("packages")->group(function() {

    Route::get('/', [PackageController::class,'index']);
    Route::post('/', [PackageController::class,'store']);
    Route::get('/{id}', [PackageController::class,'show']);
    Route::delete('/{id}', [PackageController::class,'destroy']);

});
