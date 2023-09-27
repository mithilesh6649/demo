<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Services\TestService;

class TestController extends Controller
{
    protected $testService;


    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    /**
     * Function: index
     * Functionality: This fnc will get the list of tests
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function index(Request $request)
    {
        if ($request->test_id != null) {

            $testIds = (str_contains($request->test_id, ',')) ? explode(',', $request->test_id) : (array) $request->test_id;
            $request->request->add(['test_id' => $testIds]);
            $response = $this->testService->getTestData($request);

        } else {

            $response = $this->testService->getTestsList();
        }

        return Response::json($response, $response['status']);
    }

    /**
     * Function: createOrder
     * Functionality: This fnc will buy the test for the user
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function createOrder(Request $request)
    {
        $response = $this->testService->createTestOrderWithRazorPay();

        return Response::json($response, $response['status']);
    }

    /**
     *
     * Function: buyTest
     * Functionality: This fnc will capture the payment and
     * process rest of the functionality of assigning
     * tests to the user
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function buyTest(Request $request)
    {
        $response = $this->testService->purchaseTest();

        return Response::json($response, $response['status']);
    }
}
