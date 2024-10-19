<?php

use App\Features\Lab\Controllers\LabBranchController;
use App\Features\Lab\Controllers\LabController;
use App\Features\Lab\Controllers\LabTestController;
use App\Features\Lab\Controllers\TestController;
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



Route::prefix("labs")->group(function() {
  // craete in user api
    Route::get('/', [LabController::class , 'index']);
    Route::get('/{id}', [LabController::class , 'show']);
    Route::post('/{id}', [LabController::class , 'update']);
    Route::delete('/{id}', [LabController::class , 'destroy']);

});

Route::prefix("labs-branches")->group(function() {
    // craete in user api
    Route::get('/{id}', [LabBranchController::class , 'show']);
    Route::put('/{id}', [LabBranchController::class , 'update']);
    Route::delete('/{id}', [LabBranchController::class , 'destroy']);

});
