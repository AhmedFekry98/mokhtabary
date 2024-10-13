<?php

use App\Features\Lab\Controllers\LabTestController;
use App\Features\Lab\Controllers\TestController;
use App\Features\Radiology\Controllers\RadiologyxRayController;
use App\Features\Radiology\Controllers\XRayController;
use Illuminate\Support\Facades\Route;

Route::prefix("tests")->group(function() {

    Route::get('/', [TestController::class , 'index']);
    Route::get('/{id}', [TestController::class , 'show']);
    Route::post('/', [TestController::class , 'store']);
    Route::put('/{id}', [TestController::class , 'update']);
    Route::delete('/{id}', [TestController::class , 'destroy']);

});

Route::prefix("lab-tests")->group(function() {

    Route::get('/{labId}/all', [LabTestController::class , 'index']);
    Route::post('/', [LabTestController::class , 'UpdateOrCreate']);
    Route::get('/{id}', [LabTestController::class , 'show']);
});


Route::prefix("x-rays")->group(function() {

    Route::get('/', [XRayController::class , 'index']);
    Route::get('/{id}', [XRayController::class , 'show']);
    Route::post('/', [XRayController::class , 'store']);
    Route::put('/{id}', [XRayController::class , 'update']);
    Route::delete('/{id}', [XRayController::class , 'destroy']);

});

Route::prefix("radiology-x-rays")->group(function() {

    Route::get('/{labId}/all', [RadiologyxRayController::class , 'index']);
    Route::post('/', [RadiologyxRayController::class , 'UpdateOrCreate']);
    Route::get('/{id}', [RadiologyxRayController::class , 'show']);

});