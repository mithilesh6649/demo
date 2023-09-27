<?php

namespace App\Http\Controllers\Api\V1\Trackers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\TrackerService;
use Illuminate\Http\Request;

class WaterTrackerController extends Controller
{
    protected $trackerService;

    public function __construct(TrackerService $trackerService)
    {
        $this->trackerService = $trackerService;
    }

    /**
     * Function: save
     * Functionality: it will manage the water tracking
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function save(Request $request)
    {
        $response = $this->trackerService->manipulateWaterTracker($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: setReminder
     * Functionality: Set the water reminder
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function setReminder(Request $request)
    {
        $response = $this->trackerService->setWaterReminder($request);

        return Response::json($response, $response['status']);
    }
}
