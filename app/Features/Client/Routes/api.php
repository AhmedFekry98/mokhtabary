<?php

use App\Features\Client\Controllers\ClientController;
use Illuminate\Support\Facades\Route;








Route::prefix("clients")->group(function() {

    Route::get('/',         [ClientController::class , 'index'])->middleware(['auth:sanctum']);
    Route::get('/{id}',     [ClientController::class , 'show'])->middleware(['auth:sanctum']);
    Route::post('/{id}',    [ClientController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}',  [ClientController::class , 'destroy'])->middleware(['auth:sanctum']);

});



