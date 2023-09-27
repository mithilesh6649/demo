<?php

namespace App\Http\Controllers\Api\V1\Trackers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\TrackerService;
use Illuminate\Http\Request;

class WeightTrackerController extends Controller
{
    protected $trackerService;

    public function __construct(TrackerService $trackerService)
    {
        $this->trackerService = $trackerService;
    }

    /**
     * Function: save
     * Functionality: save the user weight based on the current date
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function save(Request $request)
    {
        $response = $this->trackerService->manipulateWeightTracker($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: setReminder
     * Functionality: set the reminder for a specific date to notify user
     * for weighing thier weight.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function setReminder(Request $request)
    {
        $response = $this->trackerService->setWeightReminder($request);

        return Response::json($response, $response['status']);
    }
}
