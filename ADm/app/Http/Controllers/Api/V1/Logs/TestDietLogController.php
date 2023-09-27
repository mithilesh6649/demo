<?php

namespace App\Http\Controllers\Api\V1\Logs;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LogService;

class TestDietLogController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    public function index()
    {
        $response = $this->logService->getLog();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: save
     * Functionality: This fnc will save/update the logs for
     * tests and diet based on the date.
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function save()
    {
        $response = $this->logService->saveLog();

        return Response::json($response, $response['status']);
    }
}
