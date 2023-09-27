<?php

namespace App\Services;

use App\Http\Resources\MultipleTestLaboratoriesResource;
use App\Services\Razorpay\Order\Order as RazorPayOrder;
use App\Http\Resources\TestResource;
use App\Models\PaymentTransaction;
use App\Services\PlanService;
use App\Http\Traits\Payment;
use App\Models\UserTrait;
use App\Models\UserTest;
use App\Models\Test;
use DB;

class TestService
{
    use Payment;

    /**
     * Function: getTestsList
     * Functionality: This fnc will fetch the list of the test
     * based on the type of test like genetic test, preventive
     * test, organ test, pgx genetic test, etc
     *
     * @return array
     */
    public function getTestsList():array
    {
        $pgxGeneticTestList = $preventiveGeneticTestList = $organTestList = [];

        if (request()->test_type == "2") {

            $userTest = (request()->user_test == "true") ? auth()->user()->testPurchased : Test::whereIn('type', [2, 4])->status()->get();

            $preventiveGeneticTests = $userTest->where('type', 2);
            $pgxGeneticTests = $userTest->where('type', 4);
            $pgxGeneticTestList = TestResource::collection($pgxGeneticTests);
            $preventiveGeneticTestList = TestResource::collection($preventiveGeneticTests);

        } else {

            $organTests = Test::where('status', 1)->where('type', request()->test_type)->get();
            $organTestList = TestResource::collection($organTests);
        }

        return ['status' => 200, 'success' => true, 'data' => ['preventive_genetic_tests' => $preventiveGeneticTestList, 'pgx_genetic_tests' => $pgxGeneticTestList, 'organ_tests' => $organTestList], 'error' => false];
    }

    public function getTestData($request)
    {
        $test_search = $request->test_search;

        $tests = Test::whereIn('id', $request->test_id)
            ->where(['status' => 1, 'type' => $request->test_type])
            ->with(['laboratories.lab.metadata' => function ($qr) use ($test_search) {
                $qr->when($test_search, function ($qr) use ($test_search) {
                    return $qr->where(['state' => $test_search, 'status' => 1])->orWhere('city', $test_search);
                });
            }])->get();

        if ($tests) {

            return ['status' => 200, 'success' => true, 'data' => new MultipleTestLaboratoriesResource($tests), 'error' => false];
        }

        return ['status' => 400, 'success' => false, 'message' => 'Test not found', 'error' => true];
    }

    /**
     * Function: getTestWithLaboratoryData
     * Functionality: fetch laboratory data with test
     *
     * @param int $testId
     * @param int $labId
     *
     * @return array
     */
    public function getTestWithLaboratoryData($testId, $labId)
    {
        $tests = Test::whereId($testId)
            ->where('status', 1)
            ->with(['laboratories.lab' => function ($qr) use ($labId) {

                return $qr->where(['id' => $labId, 'status' => 1])->with('metadata');
            }])->first();

        if ($tests) {

            return ['status' => 200, 'success' => true, 'data' => new TestResource($tests), 'error' => false];
        }

        return ['status' => 400, 'success' => false, 'message' => 'Test not found', 'error' => true];
    }

    /**
     * Function: createTestOrderWithRazorPay
     * Functionality: This fnc will purchase the tests for the user
     *
     * @return array
     */
    public function createTestOrderWithRazorPay(): array
    {
        try {

            $testAmount = Payment::getTestAmount();
            $orderData = [
                'amount' => (int) ($testAmount * 100),
                'currency' => config('common.models.payment_transactions.currency'),
            ];

            $razorpayOrder = new RazorPayOrder;
            request()->merge(['payment_for' => config('common.models.payment_transactions.payment_for_test'), 'time_period' => 'one_time', 'id' => request()->test_id[0], 'test' => true]);
            $response = $razorpayOrder->createNewOrder($orderData);
            PaymentTransaction::createNewOrder($response);

            $responseData = [
                'order_id' => $response->id,
                'amount' => $testAmount,
                'currency' => config('common.models.payment_transactions.currency')
            ];

            return ['status' => 200, 'success' => true, 'data' => $responseData, 'error' => false];

        } catch (\Exception $e) {

            \Log::channel('razor_pay_request')->info(['*************************** Exception User ID: '.auth()->id().' ********************<br/> Request Body' => request()->all(), 'Response/Exeception' => $e->getMessage()]);
            return ['status' => 400, 'success' => false, 'message' => $e->getMessage(), 'error' => true];
        }
    }

    /**
     * Function: purchaseTest
     * Functionality: This fnc will purchase the tests for the user
     *
     * @return array
     */
    public function purchaseTest()
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
        DB::beginTransaction();

        try {

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

                $paymentId = PaymentTransaction::where(['razorpay_payment_id' => $paymentInf['id'], 'razorpay_order_id' => request()->order_id])->value('id');
                UserTest::setUserTest($paymentId);

                if (request()->additional_trait == "true") {

                    UserTrait::setUserTrait($paymentId);
                }

            } else {

                return ['status' => 400, 'success' => false, 'message' => "Your payment is in process", 'error' => true];
            }

            DB::commit();
            return ['status' => 200, 'success' => true, 'message' => 'Test purchased Successfully', 'error' => false];

        } catch (\Exception $e) {

            DB::rollback();

            return ['status' => 400, 'success' => false, 'message' => "Something went wrong, please wait. We'll get back to you.", 'error' => true];
        }

    }
}
