<?php

use App\Features\User\Controllers\VerificationController;
use App\Features\User\Controllers\AuthController;
use App\Features\User\Controllers\ResetPasswordController;
use App\Features\User\Controllers\UserController;
use App\Http\Middleware\CheckGuardMiddleware;
use Illuminate\Support\Facades\Route;





Route::prefix('register')->group(function () {
    Route::post('/{guard}', [UserController::class, 'register'])
        ->where('guard', 'client|lab|radiology|family|labBranch|radiologyBranch')
        ->middleware(CheckGuardMiddleware::class);
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/change-password', [AuthController::class, 'ChangePassword'])->middleware('auth:sanctum');

    Route::post('/verification/send', [VerificationController::class, 'send'])->middleware('auth:sanctum');
    Route::post('/verification/verify/{code}', [VerificationController::class, 'verify'])->middleware('auth:sanctum');

    Route::post('forgot-password',  [ResetPasswordController::class, 'forget']);
    Route::post('check-code',        [ResetPasswordController::class, 'checkCode']);
    Route::post('reset-password',   [ResetPasswordController::class, 'reset']);
});


// Route::get('/role', fn () => 'ok')->middleware(['auth:sanctum', 'role:user,clent,admin']);

