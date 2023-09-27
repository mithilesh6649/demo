<?php

namespace App\Http\Controllers\Api\V1\Trackers;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\TrackerService;
use Illuminate\Http\Request;

class MedicineTrackerController extends Controller
{
    protected $trackerService;

    public function __construct(TrackerService $trackerService)
    {
        $this->trackerService = $trackerService;
    }

    /**
     * Function: index
     * Functionality: This function will get information about
     * the medicine and its doses
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function index(Request $request)
    {
        $response = $this->trackerService->getMedicineList($request->medicine_tracker_id);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: save
     * Functionality: This function will set the medicine tracker
     * and doses reminder
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function save(Request $request)
    {
        $response = $this->trackerService->setMedicineTracker($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: deleteDose
     * Functionality: This will delete the dose remind time
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function deleteDose(Request $request)
    {
        $response = $this->trackerService->deleteMedicineDose($request);

        return Response::json($response, $response['status']);
    }

    /**
     * Function: deleteMedicineTracker
     * Functionality: This will delete the medicine tracker
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function deleteMedicineTracker(Request $request)
    {
        $response = $this->trackerService->deleteMedicineTracker($request->medicine_tracker_id);

        return Response::json($response, $response['status']);
    }
}
