<?php

use App\Features\Ledger\Controllers\LedgerController;
use Illuminate\Support\Facades\Route;

Route::prefix("ledgers")->group(function() {

    Route::get('/{id}', [LedgerController::class, 'show'])->middleware(['auth:sanctum','role:admin']);

});
