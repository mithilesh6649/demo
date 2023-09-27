<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Services\MeetingService;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    protected $meetingService;

    public function __construct(MeetingService $meetingService)
    {
        $this->meetingService = $meetingService;
    }

    public function bookAppointment(Request $request)
    {
        $response = $this->meetingService->bookAppointment($request);

        return Response::json($response, $response['status']);
    }
}
