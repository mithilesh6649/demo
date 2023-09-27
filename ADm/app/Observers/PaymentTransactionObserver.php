<?php

namespace App\Observers;

use App\Jobs\SendNotificationToUserJob;
use App\Models\PaymentTransaction;

class PaymentTransactionObserver
{
    /**
     * Handle the PaymentTransaction "created" event.
     *
     * @param  \App\Models\PaymentTransaction  $paymentTransaction
     * @return void
     */
    public function created(PaymentTransaction $paymentTransaction)
    {
        //
    }

    /**
     * Handle the PaymentTransaction "updated" event.
     *
     * @param  \App\Models\PaymentTransaction  $paymentTransaction
     * @return void
     */
    public function updated(PaymentTransaction $paymentTransaction)
    {
        if ($paymentTransaction->transaction_status == config('common.confidentials.payment_gateway.razor_pay.payment_keywords.captured')) {

            if (auth()->user()->email_notification ) {

                $data = [
                    'user_name' => auth()->user()->name,
                    'user_email' => auth()->user()->email,
                    'phone_number' => '+'.auth()->user()->country_code.auth()->user()->phone_number,
                ];

                dispatch(new SendNotificationToUserJob($paymentTransaction->payment_for, $data));
            }
        }
    }

    /**
     * Handle the PaymentTransaction "deleted" event.
     *
     * @param  \App\Models\PaymentTransaction  $paymentTransaction
     * @return void
     */
    public function deleted(PaymentTransaction $paymentTransaction)
    {
        //
    }

    /**
     * Handle the PaymentTransaction "restored" event.
     *
     * @param  \App\Models\PaymentTransaction  $paymentTransaction
     * @return void
     */
    public function restored(PaymentTransaction $paymentTransaction)
    {
        //
    }

    /**
     * Handle the PaymentTransaction "force deleted" event.
     *
     * @param  \App\Models\PaymentTransaction  $paymentTransaction
     * @return void
     */
    public function forceDeleted(PaymentTransaction $paymentTransaction)
    {
        //
    }
}
