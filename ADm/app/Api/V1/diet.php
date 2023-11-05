<?php

use Illuminate\Support\Facades\Route;

use Food\FoodController;

Route::controller(DietController::class)->group(function () {

    Route::get('/', 'diet');
    Route::get('/plans', 'plans');
    Route::post('/save/fdpre-and-alrg', 'saveFoodPreferenceAndAllergy');
    Route::get('pref-allergy', 'getFoodPreferencesAndAllergies');
    Route::post('save/food', 'saveFood');

    Route::controller(SpecializedDietController::class)->group(function () {

        Route::get('specialized', 'getSpecializedDiet');
    });

    Route::prefix('food')->controller(FoodController::class)->group(function () {

        Route::get('/search/{food}', 'getFood');
        Route::get('favourite', 'getFavouriteFood');
        Route::get('recommend', 'recommendFood');
        Route::get('check', 'checkFoodAddedOrNot');
        Route::get('recipe', 'foodRecipe');
        Route::patch('track', 'trackFood');
    });
});
