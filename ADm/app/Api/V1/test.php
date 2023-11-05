<?php

use Illuminate\Support\Facades\Route;

Route::controller(TestController::class)->group(function () {

    Route::post('create/order', 'createOrder');
    Route::post('buy', 'buyTest');
});
