<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function(){
    dd('hee');
});

Route::controller(AuthController::class)->group(function() {

    Route::post('/register', '_register');
    Route::post('/login', '_login')->middleware('verify');
    Route::post('/verify/otp', '_verifyOTP');
    Route::post('/resend/otp', '_resendOTP');
    Route::post('/forgot/password', '_forgotPassowrd');

    Route::middleware('auth:api')->group(function() {

        Route::post('/verify/updated/info', '_reVerifyEmailOrPhone');
        Route::delete('/delete/account', '_deleteUserAccount');
    });
});

