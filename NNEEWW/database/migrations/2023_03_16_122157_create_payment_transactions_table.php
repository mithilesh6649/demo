<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_order_id')->nullable();
            $table->char('payment_for_id');
            $table->char('payment_for')->comment('test | diet plan subscription');
            $table->float('amount')->nullable();
            $table->char('currency', '25')->nullable();
            $table->datetime('captured_time');
            $table->char('transaction_status', '20')->comment('pending | success | failed | refund');
            $table->unSignedBigInteger('discount_id')->nullable();
            $table->char('gateway', '20')->comment('stripe | paypal | razorpay');
            $table->char('method', '20')->comment('card | ideal | paypal');
            $table->string('description');
            $table->json('metadata');
            $table->timestamps();
            $table->softDeletes();

            $table->index('razorpay_payment_id');
            $table->index('gateway');
            $table->index('transaction_status');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('discount_id', 'transaction_events_dis_foreign')->references('id')->on('diet_plan_subscription_discounts')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_transactions', function (Blueprint $table) {

            $table->dropIndex(['razorpay_payment_id', 'gateway', 'transaction_status']);
            $table->dropForeign('payment_transactions_user_id_foreign', 'transaction_events_dis_foreign');
        });
    }
}
