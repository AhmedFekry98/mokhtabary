<?php

use App\Features\Client\Controllers\ClientController;
use App\Features\Client\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;








Route::prefix("clients")->group(function() {

    Route::get('/',         [ClientController::class , 'index']);
    Route::get('/{id}',     [ClientController::class , 'show']);
    Route::post('/{id}',    [ClientController::class , 'update']);
    Route::delete('/{id}',  [ClientController::class , 'destroy']);

});

Route::prefix("clients-families")->group(function() {
    Route::get('/{id}',    [FamilyController::class , 'show']);
    Route::post('/{id}',    [FamilyController::class , 'update']);
    Route::delete('/{id}',  [FamilyController::class , 'destroy']);
});



