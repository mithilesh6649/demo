<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transaction_items', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('payment_transaction_id');
            $table->char('type');
            $table->float('amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payment_transaction_id')->references('id')->on('payment_transactions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_transaction_items', function (Blueprint $table) {
            $table->dropColumn(['payment_transaction_items_payment_transaction_id_foreign']); 
        });
    }
}
