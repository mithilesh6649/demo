<?php

namespace App\Http\Controllers\Api\V1\Plan;

use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Services\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    protected $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    /**
     * Function: planInfo
     * Functionality: This will fetch the individual plan info
     *
     * @param Illuminate\Http\Request
     */
    public function planInfo(Request $request)
    {
        if($request->diet == "true") {

            $response = $this->planService->fetchPlanInfo();
            return Response::json($response, $response['status']);

        } else {

            $response = $this->planService->fetchTestInfo();
            return Response::json($response, $response['status']);
        }
    }

    /**
     * Function: buyPlan
     * Functionality: This will fetch the individual plan info
     *
     * @param Illuminate\Http\Request
     */
    public function buyPlan(Request $request)
    {
        $response = $this->planService->buyDietPlan();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: CreateOrder
     * Functionality: This Fnc will create a new order of a plan
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Response
     */
    public function createOrder(Request $request)
    {
        $response = $this->planService->createOrder();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: destroyOrder
     * Functionality: This function trigger when the payment has been
     * failed due to any reason, then the order will be cancelled
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Response
     */
    public function destroyOrder(Request $request)
    {
        $response = $this->planService->changeOrderStatus();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: checkPlan
     * Functionality: This Fnc check if user has purchased the
     * premium plan or not
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Response
     */
    public function checkPlan()
    {
        $response = ['status' => 200, 'success' => true, 'data' => auth()->user()->isPremiumPlanPurchased(), 'error' => false];

        return Response::json($response, $response['status']);
    }

    /**
     * Function: fetchSubPlanInfo
     * Functionality: This Fnc will get the information about
     * the dna metabolic diet subscription plan.
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Response
     */
    public function fetchSubPlanInfo()
    {
        $response = $this->planService->getSubDietPlan();

        return Response::json($response, $response['status']);
    }

    /**
     * Function: getDietPlanFeaturesAndPricing
     * Functionality: This Fnc will get the features and pricing
     * of the diet plan
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Response
     */
    public function getDietPlanFeaturesAndPricing()
    {
        $response = $this->planService->getDietPlanSubscriptionFeatureAndPricing();

        return Response::json($response, $response['status']);
    }
}
