<?php

namespace App\Http\Controllers\Api\V1\Trackers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\TrackerService;
use Illuminate\Http\Request;

class CommonTrackerController extends Controller
{
    /**
     * Function: index
     * Functionality: Get the list of weight (currently per month)
     *
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function index(Request $request, TrackerService $trackerService)
    {
        $response = $trackerService->getTrackerList($request);

        return Response::json($response, $response['status']);
    }
}
