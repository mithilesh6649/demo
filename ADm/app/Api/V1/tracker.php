<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Trackers\CommonTrackerController;

Route::middleware('auth:api')->group(function () {

    Route::get('/', [CommonTrackerController::class, 'index']);

    Route::prefix('weight')->controller(WeightTrackerController::class)->group(function () {

        Route::post('/save', 'save');
        Route::post('/reminder', 'setReminder');
    });

    Route::prefix('water')->controller(WaterTrackerController::class)->group(function () {

        Route::post('/save', 'save');
        Route::post('/reminder', 'setReminder');
    });

    Route::prefix('medicine')->controller(MedicineTrackerController::class)->group(function () {

        Route::get('/', 'index');
        Route::post('/save', 'save');
        Route::delete('/', 'deleteMedicineTracker');
        Route::delete('/dose', 'deleteDose');
        Route::post('/reminder', 'setReminder');
    });

    Route::prefix('pulse')->controller(PulseTrackerController::class)->group(function () {

        Route::post('/save', 'save');
    });

    Route::prefix('step')->controller(StepTrackerController::class)->group(function () {

        Route::post('save', 'manageSteps');
        Route::post('/reminder', 'setReminder');
    });
});
