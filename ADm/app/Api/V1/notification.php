<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->controller(NotificationController::class)->group(function () {

    Route::get('/', 'index');
    Route::delete('delete', 'delete');
    Route::patch('read', 'read');
    Route::post('/send/test/push/notification', 'sendTestPushNotification');
});
