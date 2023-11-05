<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {

    Route::controller(ExerciseController::class)->group(function () {

        Route::get('/', 'addFavOrGetExercise');
        Route::get('fav', 'getFavouriteExercises');
        Route::post('save', 'saveExercise');
        Route::get('added-exercise', 'getAddedExercise');
        Route::delete('delete', 'deleteAddedExercise');
    });
});
