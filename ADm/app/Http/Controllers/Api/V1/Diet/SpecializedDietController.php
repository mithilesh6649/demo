<?php

namespace App\Http\Controllers\Api\V1\Diet;

use App\Services\SpecializedDietService;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecializedDietController extends Controller
{
    public function getSpecializedDiet(SpecializedDietService $specializedDietService)
    {
        $response = $specializedDietService->getSpecializedDietOpted();
         
        return Response::json($response, $response['status']);
    }
}
