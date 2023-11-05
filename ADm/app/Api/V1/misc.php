<?php

use Illuminate\Support\Facades\Route;

Route::controller(MiscController::class)->group(function () {

    Route::get('/faq', 'faqInfo');
});


