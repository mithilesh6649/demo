<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentTransactionIdColumnInUserDietPlanSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_diet_plan_subscriptions', function (Blueprint $table) {
            $table->unSignedBigInteger('payment_transaction_id')->after('id')->nullable();

            $table->foreign('payment_transaction_id', 'user_plan_payment_txn_id_foreign')->references('id')->on('payment_transactions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_diet_plan_subscriptions', function (Blueprint $table) {
            $table->dropForeign(['user_plan_payment_txn_id_foreign']);
        });
    }
}
