<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Jobs\SendNotificationToUserJob;
use Illuminate\Database\Eloquent\Model;
use Auth;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_for_time_period',
        'payment_transation_id',
        'razorpay_payment_id',
        'transaction_status',
        'transaction_reason',
        'razorpay_order_id',
        'transaction_id',
        'payment_for_id',
        'captured_time',
        'payment_for',
        'discount_id',
        'description',
        'currency',
        'metadata',
        'user_id',
        'gateway',
        'amount',
        'method',
    ];

    public function setMetadataAttribute($json)
    {
        $this->attributes['metadata'] = json_encode($json);
    }

    public function setCaptureTimeAttribute($captureTime)
    {
        $this->attributes['capture_time'] = \Carbon\Carbon::createFromTimestamp($captureTime)->toDateTimeString();
    }

    public function createNewOrder($orderObject)
    {
        $paymentTransaction = PaymentTransaction::updateOrCreate([
            'transaction_status' => config('common.models.payment_transactions.transaction_status.created'),
            'payment_for' => request()->payment_for,
            'payment_for_time_period' => request()->time_period ?? request()->duration,
            'payment_for_id' => request()->id,
            'razorpay_order_id' => $orderObject->id,
            'user_id' => auth()->id(),
        ], [
            'created_at' => $orderObject->created_at,
            'amount' => $orderObject->amount / 100,
            'currency' => $orderObject->currency,
        ]);
    }

    public function userDietPlan()
    {
        return $this->hasOne(UserDietPlanSubscription::class);
    }

    public function getPaymentTransactionInfo()
    {
        return PaymentTransaction::where([
            'razorpay_order_id' => request()->order_id,
            'user_id' => auth()->id()
        ])->first();
    }

    public function changePaymentTransaction($orderId, $updateData)
    {
        $paymenTransactionInfo = PaymentTransaction::where(['razorpay_order_id' => $orderId, 'user_id' => auth()->id()])->first();
        $paymenTransactionInfo->update($updateData);
    }

    protected static function boot()
    {
        parent::boot();

        PaymentTransaction::observe(new \App\Observers\PaymentTransactionObserver);
    }
}
