<?php

use App\Features\Chat\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/join-chat', [ChatController::class, 'joinChat']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/fetch-messages/{chatId}', [ChatController::class, 'fetchMessages']);
    Route::get('/fetch-chat-members/{chatId}', [ChatController::class, 'fetchChatMembers']);
});
