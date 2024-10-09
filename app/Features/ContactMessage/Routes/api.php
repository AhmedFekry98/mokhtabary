<?php

use App\Features\ContactMessage\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::prefix("contact-messages")->group(function() {

    Route::get('/', [ContactMessageController::class , 'index']);
    Route::post('/', [ContactMessageController::class , 'store']);
    Route::get('/{id}', [ContactMessageController::class , 'show']);
    Route::delete('/{id}', [ContactMessageController::class , 'destroy']);
    Route::put('/read/{id}', [ContactMessageController::class , 'readAt']);

});
