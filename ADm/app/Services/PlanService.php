<?php

namespace App\Services;

use App\Http\Controllers\Api\V1\Payment\PaymentController;
use App\Services\Razorpay\Order\Order as RazorPayOrder;
use App\Http\Resources\SubDietPlanSubscriptionResource;
use App\Http\Resources\SubPlanSubscriptionResource;
use App\Http\Resources\IndividualDietPlanResource;
use App\Http\Resources\SubPlanPricingResource;
use App\Models\UserDietPlanSubscription;
use App\Models\DietPlanSubscription;
use App\Models\PaymentTransaction;
use App\Http\Traits\DietPlan;
use App\Http\Traits\Payment;
use App\Models\MdDropdown;
use App\Models\Feature;
use RazorPayCustomer;
use App\Models\Test;
use DB;

class PlanService
{
    use Payment, DietPlan;

    /**
     * Function: fetchPlanInfo
     * Functionality: This fnc will fetch the individual diet plan information
     * with feature which is enabled with the particular plan
     *
     * @return array
     */
    public function fetchPlanInfo(): array
    {
        $planInfo = DietPlanSubscription::getPlan(request()->diet_plan_id);
        $features = Feature::select('id', 'name')->where('type', 1)->get()->toArray();
        $planFeatures = [];
        $accesseblePlanFeature = $planInfo->features->pluck('id')->toArray();

        foreach ($features as $feature) {

            $planFeature [] = [
                'name' => $feature['name'],
                'active' => (in_array($feature['id'], $accesseblePlanFeature)) ? true : false
            ];
        }

        if(debug_backtrace()[1]['function'] == "getDietPlanSubscriptionFeatureAndPricing") {

            return ['status' => 200, 'success' => true, 'data' => ['features' => $planFeature, 'pricing' => []], 'error' => false];
        }

        $planActive = UserDietPlanSubscription::planTimePeriod(request()->diet_plan_id);

        return ['status' => 200, 'success' => true, 'data' => ['plan' => (new IndividualDietPlanResource($planInfo))->featureEnabled($planFeature), 'plan_active' => $planActive], 'error' => false];
    }

    /**
     * Function: fetchTestInfo
     * Functionality: This fnc will fetch the individual test information
     *
     *
     * @return array
     */

    public function fetchTestInfo():array
    {
       $testInfo =  Test::where('id', request()->dna_id)->first();
       $testsAmount = MdDropdown::where('module','genetic_test_pricing')->get();
       $multipleGenetic = $testsAmount->where('slug', 'any_two_pricing')->first()->value;
       $all_six_pricing = $testsAmount->where('slug', 'all_six_pricing')->first()->value;
       $additional_traits = $testsAmount->where('slug', 'additional_traits')->first()->value;

      $data = [
            'id' => $testInfo->id,
            'name' => $testInfo->name,
            'diet'=>false,
            'pricing' => [
                'genetic_amount' => $testInfo->amount,
                'multiple_test' => [
                   'quantity' => (int) $testsAmount->where('slug', 'any_two_pricing')->first()->name,
                   'amount' => (int) $multipleGenetic
                ],
                'six_genetic' => (int) $all_six_pricing,
                'additional_traits' => (int) $additional_traits,
            ],
             'description' =>  $testInfo->description,
            'image' =>  $testInfo->image,
            'is_purchased' => auth()->user()->isTestPurchased(request()->dna_id),
            'features' =>[],
            'additional_information'=>$testInfo->add_info,
        ];

      return ['status' => 200, 'success' => true,'data' => ['plan' => $data ], 'error' => false];
    }

    /**
     * Function: buyDietPlan
     * Functionality: This Fnc will assign the diet plan to user
     *
     * @return array
     */
    public function buyDietPlan():array
    {
        try {
            $razorPaySer = new RazorPayOrder;
            $razorPaySer->verifySignature();
            return $this->checkPaymentStatus($razorPaySer->fetchPayment());

        } catch (\Exception $e) {

            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: checkPaymentStatus
     * Functionality: This Fnc will check the payment status
     * and assign the diet plan to the user
     *
     * @param object $paymentObj
     *
     * @return array
     */
    private function checkPaymentStatus($paymentObj): array
    {
        $paymentInf = $paymentObj->toArray();

        $updateData = [
            'razorpay_payment_id' => $paymentInf['id'],
            'transaction_status' => $paymentInf['status'],
            'gateway' => config('common.confidentials.payment_gateway.payment_gateway_providers.razorpay'),
            'method' => $paymentInf['method'],
            'metadata' => $paymentInf,
            'captured_time' => $paymentInf['created_at'],
        ];

        PaymentTransaction::changePaymentTransaction(request()->order_id, $updateData);

        if ($paymentInf['status'] == config('common.confidentials.payment_gateway.razor_pay.payment_keywords.captured')) {

            $this->setDietPlan($paymentInf['id']);

        } else {

            return ['status' => 400, 'success' => false, 'message' => "Your payment is in process", 'error' => true];
        }

        return ['status' => 200, 'success' => true, 'message' => 'Plan purchased Successfully', 'error' => false];
    }

    /**
     * Function: createCustomerInRazorPay
     * Functionality: This Fnc will create new customer in razor pay gateway
     *
     */
    private function createCustomerInRazorPay($customerData)
    {
        $customerData = RazorPayCustomer::createCustomer($customerData);

        if (isset($customerData['error'])) {

            $errorData = [
                'message' => $customerData['description'] ?? null,
                'status' => 400,
                'success' => false,
                'error' => true
            ];

            return $errorData;
        }
    }

    /**
     * Function: createOrder
     * Functionality: This will create a new order for a user
     *
     * @return array
     */
    public function createOrder(): array
    {
        try {

            request()->merge(['payment_for' => config('common.models.payment_transactions.payment_for_diet_plans'), 'id' => request()->diet_plan_id, 'time_period' => (int) filter_var(request()->duration, FILTER_SANITIZE_NUMBER_INT)]);
            $dietPlanAmount = $this->getDietPlanAmount();

            $orderData = [
                'amount' => (int) ($dietPlanAmount * 100),
                'currency' => config('common.models.payment_transactions.currency'),
            ];

            $razorpayOrder = new RazorPayOrder;
            $response = $razorpayOrder->createNewOrder($orderData);

            PaymentTransaction::createNewOrder($response);

            $responseData = [
                'order_id' => $response->id,
                'amount' => $dietPlanAmount,
                'currency' => config('common.models.payment_transactions.currency')
            ];

            return ['status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];

        } catch (\Exception $e) {

            \Log::channel('razor_pay_request')->info(['*************************** Exception User ID: '.auth()->id().' ********************<br/> Request Body' => request()->all(), 'Response/Exeception' => $e->getMessage()]);
            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: changeOrderStatus
     * Functionality: Fnc will change the status of the order
     *
     * @return array
     */
    public function changeOrderStatus():array
    {
        $data = [
            'transaction_status' => config('common.models.payment_transactions.transaction_status.failed'),
            'transaction_reason' => request()->description,
            'metadata' => ['code' => request()->code, 'message' => request()->description],
        ];

        PaymentTransaction::changePaymentTransaction(request()->order_id, $data);

        return ['status' => 200, 'success' => true, 'message' => 'Payment failed', 'error' => true];
    }

    /**
     * Function: getSubDietPlan
     * Functionality: Fnc will fetch the details of diet plan subscription sub plan
     * info
     *
     * @return array
     */
    public function getSubDietPlan():array
    {
        $dietSubPlanSubscription = DietPlanSubscription::whereId(request()->diet_plan_id)->with('subPlan.subPlanFeatures')->first();

        return ['status' => 200, 'success' => true, 'data' => SubDietPlanSubscriptionResource::collection($dietSubPlanSubscription->subPlan), 'error' => false];
    }

    /**
     * Function: getDietPlanSubscriptionFeatureAndPricing
     * Functionality: Fnc will fetch the features and price of diet
     * plan subscription sub plans
     *
     * @return array
     */
    public function getDietPlanSubscriptionFeatureAndPricing():array
    {

        $dietPlanSubscription = DietPlanSubscription::whereId(request()->diet_plan_id)->with(['singleSubPlan.pricing.pricingSubPlanFeatures', 'singleSubPlan' => function ($qr) {
            $qr->where('diets.id', request()->sub_plan_id)->first();
        }])->first();

        return ['status' => 200, 'success' => true, 'data' => SubPlanPricingResource::collection($dietPlanSubscription->singleSubPlan->pricing), 'error' => false];

        // if (request()->diet_plan_id == config('common.models.diet_plan_subscriptions.free_plan_id')) {

        //     return $this->fetchPlanInfo();

        // } else if (request()->diet_plan_id == config('common.models.diet_plan_subscriptions.metabolic_plan_id')) {

        //     $dietPlanSubscription = DietPlanSubscription::whereId(request()->diet_plan_id)->with('singleSubPlan.pricing')->first();

        //     return ['status' => 200, 'success' => true, 'data' => new SubPlanSubscriptionResource($dietPlanSubscription->singleSubPlan), 'error' => false];

        // } else {

        //     $dietPlanSubscription = DietPlanSubscription::whereId(request()->diet_plan_id)->with(['singleSubPlan.pricing', 'singleSubPlan' => function ($qr) {
        //         $qr->where('diets.id', request()->sub_plan_id)->first();
        //     }])->first();

        //     return ['status' => 200, 'success' => true, 'data' => new SubPlanSubscriptionResource($dietPlanSubscription->singleSubPlan), 'error' => false];
        // }
    }
}
