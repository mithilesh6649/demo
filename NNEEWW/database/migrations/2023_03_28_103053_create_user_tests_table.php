<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('payment_transaction_id')->nullable();
            $table->unSignedBigInteger('user_id');
            $table->unSignedBigInteger('test_id');
            $table->tinyInteger('test_done')->comment('0|not done  1|done  2|');
            $table->datetime('expired_on');
            $table->timestamps();
            $table->softDeletes();

            $table->index('test_done');
            $table->foreign('payment_transaction_id')->references('id')->on('payment_transactions')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tests', function (Blueprint $table) {

            $table->dropIndex(['test_done']);
            $table->dropForeign(['user_tests_payment_transaction_id_foreign', 'user_tests_user_id_foreign', 'user_tests_test_id_foreign']);
        });
    }
}
