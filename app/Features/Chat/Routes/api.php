<?php

use App\Features\Chat\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'        => '/chats',
    'middleware'    =>  ['auth:sanctum']
], function() {
    Route::get('/', [ChatController::class, 'chats']);
    Route::post('/send-message', [ChatController::class, 'storeMessage']);
    Route::get('/{chatId}', [ChatController::class, 'showChat']);
});
