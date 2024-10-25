<?php

use App\Features\CompanyProfile\Controllers\BasicInformationController;
use App\Features\CompanyProfile\Controllers\CityController;
use App\Features\CompanyProfile\Controllers\GovernorateController;
use App\Features\CompanyProfile\Controllers\PartnerController;
use App\Features\CompanyProfile\Controllers\PolicyController;
use App\Features\CompanyProfile\Controllers\QuestionAnswerController;
use App\Features\CompanyProfile\Controllers\TermConditionController;
use Illuminate\Support\Facades\Route;



Route::prefix("policy")->group(function() {

    Route::get('/', [PolicyController::class , 'index']);
    Route::post('/', [PolicyController::class , 'store'])->middleware(['auth:sanctum']);
    Route::get('/{id}', [PolicyController::class , 'show']);
    Route::put('/{id}', [PolicyController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [PolicyController::class , 'destroy'])->middleware(['auth:sanctum']);

});


Route::prefix("term-condition")->group(function() {

    Route::get('/', [TermConditionController::class , 'index']);
    Route::post('/', [TermConditionController::class , 'store'])->middleware(['auth:sanctum']);
    Route::get('/{id}', [TermConditionController::class , 'show']);
    Route::put('/{id}', [TermConditionController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [TermConditionController::class , 'destroy'])->middleware(['auth:sanctum']);

});


Route::prefix("question-answer")->group(function() {

    Route::get('/', [QuestionAnswerController::class , 'index']);
    Route::post('/', [QuestionAnswerController::class , 'store'])->middleware(['auth:sanctum']);
    Route::get('/{id}', [QuestionAnswerController::class , 'show']);
    Route::put('/{id}', [QuestionAnswerController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [QuestionAnswerController::class , 'destroy'])->middleware(['auth:sanctum']);

});


Route::prefix("basic-information")->group(function() {
    Route::post('/', [BasicInformationController::class , 'updateOrCreate'])->middleware(['auth:sanctum']);
    Route::get('/', [BasicInformationController::class , 'show']);
});



Route::prefix("governorate")->group(function() {
    Route::get('/', [GovernorateController::class , 'index']);
    Route::post('/', [GovernorateController::class , 'store'])->middleware(['auth:sanctum']);
    Route::get('/{id}', [GovernorateController::class , 'show']);
    Route::put('/{id}', [GovernorateController::class , 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [GovernorateController::class , 'destroy'])->middleware(['auth:sanctum']);
});


Route::prefix("city")->group(function() {
    Route::post('/', [CityController::class , 'store'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [CityController::class , 'destroy'])->middleware(['auth:sanctum']);
});


Route::prefix("partner")->group(function() {
    Route::get('/', [PartnerController::class , 'index']);
    Route::post('/', [PartnerController::class , 'store'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [PartnerController::class , 'destroy'])->middleware(['auth:sanctum']);
});




