<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MiscController extends Controller
{
    public function faqInfo()
    {
        $faqData = DB::table('faq')->select('question', 'answer')->get();

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $faqData,
            'error' => false,
        ], 200);
    }
}
