<?php

namespace App\Services;

use App\Http\Resources\TestDietLogResource;
use App\Http\Resources\GraphLogResource;
use App\Models\UserDietTestLog;


class LogService {

    protected $userDietTestlog;

    public function __construct(UserDietTestLog $userDietTestlog)
    {
        $this->userDietTestlog = $userDietTestlog;
    }

    public function saveLog()
    {
        try {

            $this->userDietTestlog->updateOrSave();

            return ['status' => 200, 'success' => true, 'message' => 'Logs successfully saved', 'error' => false];

        } catch (\Exception $e) {

            \Log::info(['********error from saving log********' => $e]);

            return ['status' => 400, 'success' => false, 'message' => 'Something went wrong!', 'error' => true];
        }
    }

    public function getLog()
    {
        if (request()->log_type) {

            if (in_array(request()->log_type, config('common.models.user_diet_and_test_logs.excluded_ids'))) {

                $particularLog = (request()->log_type == 16) ? auth()->user()->weightTracker : auth()->user()->pulseTracker;

            } else {

                $particularLog = $this->userDietTestlog->getLogs();
            }

            $data = GraphLogResource::collection($particularLog);

        } else {

            $logsData = auth()->user()->testDietLogsBasedOnDate;

            $data = ($logsData == null) ? null : new TestDietLogResource(auth()->user()->testDietLogsBasedOnDate);
        }

        return ['status' => 200, 'success' => true, 'data' => $data, 'error' => false];
    }
}
