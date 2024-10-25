<?php

use App\Features\Client\Controllers\ClientController;
use App\Features\Client\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;








Route::prefix("clients")->group(function() {

    Route::get('/',         [ClientController::class , 'index'])->middleware(['auth:sanctum']);
    Route::get('/{id}',     [ClientController::class , 'show'])->middleware(['auth:sanctum']);
    Route::post('/{id}',    [ClientController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}',  [ClientController::class , 'destroy'])->middleware(['auth:sanctum']);

});

Route::prefix("clients-families")->group(function() {
    Route::get('/{id}',    [FamilyController::class , 'show'])->middleware(['auth:sanctum']);
    Route::post('/{id}',    [FamilyController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}',  [FamilyController::class , 'destroy'])->middleware(['auth:sanctum']);
});



