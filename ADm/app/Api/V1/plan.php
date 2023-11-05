<?php

use Illuminate\Support\Facades\Route;

Route::controller(PlanController::class)->group(function () {

    Route::get('/', 'planInfo');
    Route::post('create/order', 'createOrder');
    Route::post('buy', 'buyPlan');
    Route::post('order/failed', 'destroyOrder');
    Route::get('check', 'checkPlan');
    Route::get('sub-plan', 'fetchSubPlanInfo');
    Route::get('diet-feature-pricing', 'getDietPlanFeaturesAndPricing');
});
