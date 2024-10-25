<?php

use App\Features\CompanyProfile\Controllers\BasicInformationController;
use App\Features\CompanyProfile\Controllers\CityController;
use App\Features\CompanyProfile\Controllers\GovernorateController;
use App\Features\CompanyProfile\Controllers\PolicyController;
use App\Features\CompanyProfile\Controllers\QuestionAnswerController;
use App\Features\CompanyProfile\Controllers\TermConditionController;
use Illuminate\Support\Facades\Route;



Route::prefix("policy")->group(function() {

    Route::get('/', [PolicyController::class , 'index']);
    Route::post('/', [PolicyController::class , 'store']);
    Route::get('/{id}', [PolicyController::class , 'show']);
    Route::put('/{id}', [PolicyController::class , 'update']);
    Route::delete('/{id}', [PolicyController::class , 'destroy']);

});


Route::prefix("term-condition")->group(function() {

    Route::get('/', [TermConditionController::class , 'index']);
    Route::post('/', [TermConditionController::class , 'store']);
    Route::get('/{id}', [TermConditionController::class , 'show']);
    Route::put('/{id}', [TermConditionController::class , 'update']);
    Route::delete('/{id}', [TermConditionController::class , 'destroy']);

});


Route::prefix("question-answer")->group(function() {

    Route::get('/', [QuestionAnswerController::class , 'index']);
    Route::post('/', [QuestionAnswerController::class , 'store']);
    Route::get('/{id}', [QuestionAnswerController::class , 'show']);
    Route::put('/{id}', [QuestionAnswerController::class , 'update']);
    Route::delete('/{id}', [QuestionAnswerController::class , 'destroy']);

});


Route::prefix("basic-information")->group(function() {
    Route::post('/', [BasicInformationController::class , 'updateOrCreate']);
    Route::get('/', [BasicInformationController::class , 'show']);
});



Route::prefix("governorate")->group(function() {
    Route::get('/', [GovernorateController::class , 'index']);
    Route::post('/', [GovernorateController::class , 'store']);
    Route::get('/{id}', [GovernorateController::class , 'show']);
    Route::put('/{id}', [GovernorateController::class , 'update']);
    Route::delete('/{id}', [GovernorateController::class , 'destroy']);
});


Route::prefix("city")->group(function() {
    Route::post('/', [CityController::class , 'store']);
    Route::delete('/{id}', [CityController::class , 'destroy']);
});

