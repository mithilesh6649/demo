<?php

namespace App\Http\Controllers\Api\V1\Trackers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\TrackerService;
use Illuminate\Http\Request;

class StepTrackerController extends Controller
{
    protected $trackerService;

    public function __construct(TrackerService $trackerService)
    {
        $this->trackerService = $trackerService;
    }

    /**
     * Function: manageSteps
     * Functionality: This function will update/create the steps of the user
     * based on the date
     *
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function manageSteps(Request $request)
    {
        $response = $this->trackerService->manageStepsData($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: setReminder
     * Functionality: This function will set step reminder
     * for the user based on time
     *
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function setReminder(Request $request)
    {
        $response = $this->trackerService->setStepReminder($request);

        return Response::json($response, $response['status']);
    }
}
