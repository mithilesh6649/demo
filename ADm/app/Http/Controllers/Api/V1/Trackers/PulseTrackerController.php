<?php

namespace App\Http\Controllers\Api\V1\Trackers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\TrackerService;
use Illuminate\Http\Request;

class PulseTrackerController extends Controller
{
    protected $trackerService;

    public function __construct(TrackerService $trackerService)
    {
        $this->trackerService = $trackerService;
    }

    public function save(Request $request)
    {
        $response = $this->trackerService->managePulseTracker();

        return Response::json($response, $response['status']);
    }
}
