<?php

use App\Features\Radiology\Controllers\RadiologyBranchController;
use App\Features\Radiology\Controllers\RadiologyController;
use App\Features\Radiology\Controllers\RadiologyxRayController;
use App\Features\Radiology\Controllers\XRayController;
use Illuminate\Support\Facades\Route;

Route::prefix("x-rays")->group(function() {

    Route::get('/', [XRayController::class , 'index']);
    Route::get('/{id}', [XRayController::class , 'show']);
    Route::post('/', [XRayController::class , 'store'])->middleware(['auth:sanctum']);
    Route::put('/{id}', [XRayController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [XRayController::class , 'destroy'])->middleware(['auth:sanctum']);

});

Route::prefix("radiology-x-rays")->group(function() {

    Route::get('/{labId}/all', [RadiologyxRayController::class , 'index']);
    Route::post('/', [RadiologyxRayController::class , 'UpdateOrCreate']);
    Route::get('/{id}', [RadiologyxRayController::class , 'show']);

});


Route::prefix("radiologies")->group(function() {
    // craete in user api
      Route::get('/', [RadiologyController::class , 'index']);
      Route::get('/{id}', [RadiologyController::class , 'show']);
      Route::post('/{id}', [RadiologyController::class , 'update'])->middleware(['auth:sanctum']);
      Route::delete('/{id}', [RadiologyController::class , 'destroy'])->middleware(['auth:sanctum']);

  });

  Route::prefix("radiologies-branches")->group(function() {
      // craete in user api
      Route::get('/{id}', [RadiologyBranchController::class , 'show']);
      Route::put('/{id}', [RadiologyBranchController::class , 'update'])->middleware(['auth:sanctum']);
      Route::delete('/{id}', [RadiologyBranchController::class , 'destroy'])->middleware(['auth:sanctum']);

  });
