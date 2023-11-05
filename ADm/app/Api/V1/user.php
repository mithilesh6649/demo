<?php

use App\Http\Controllers\Api\V1\Ticket\TicketController;
use App\Http\Controllers\Api\V1\LaboratoryController;
use App\Http\Controllers\Api\V1\MeetingController;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;
use Logs\TestDietLogController;
use Traits\TraitController;
use Chat\ChatController;

Route::middleware('auth:api')->group(function () {

    Route::controller(UserController::class)->group(function () {

        Route::get('/profile', 'index');
        Route::post('/notification', 'manageNotification');
        Route::put('/profile', 'update');
        Route::put('/update', 'updateProfile');
        Route::post('/health/status', 'saveHealthStatus');
    });
    Route::get('/test', [TestController::class, 'index']);

    Route::group(['controller' => TraitController::class, 'prefix' => 'traits'], function ()  {

        Route::get('/', 'index');
        Route::get('list', 'listing');
    });
    Route::controller(ReportController::class)->group(function () {

        Route::post('/upload/report', 'save');

        Route::prefix('report')->group(function () {

            Route::get('/', 'reports');
            Route::get('all', 'getAllReports');
            Route::delete('destroy', 'destroyReport');
        });
    });
    Route::controller(ChatController::class)->group(function () {

        Route::get('messages', 'messages');
    });
    Route::get('tickets', [TicketController::class, 'index']);
    Route::get('/laboratory', [LaboratoryController::class, 'index']);
    Route::post('appointment/book', [MeetingController::class, 'bookAppointment']);

    Route::group(['controller' => TestDietLogController::class, 'prefix' => 'log'], function () {

        Route::get('/', 'index');
        Route::post('save', 'save');
    });
    Route::post('logs', [TestDietLogController::class, 'save']);
    Route::get('/logout', [AuthController::class, 'logout']);
});


