<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\LaboratoryService;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index(Request $request, LaboratoryService $labService)
    {
        $response = $labService->getLabData($request->lab_id);

        return Response::json($response, $response['status']);
    }
}
