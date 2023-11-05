<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::controller(ConsultantController::class)->group(function () {

        Route::get('/', 'consultant');
        Route::get('list', 'index');
        Route::get('review', 'reviews');
        Route::post('review', 'saveReview');
        Route::get('availability', 'availabilityTime');
    });
});
