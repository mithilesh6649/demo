<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_traits', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('payment_transaction_id');
            $table->unSignedBigInteger('trait_list_id');
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('payment_transaction_id')->references('id')->on('payment_transactions')->onDelete('CASCADE');
            $table->foreign('trait_list_id')->references('id')->on('trait_lists')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_traits', function (Blueprint $table) {
            $table->dropForeign(['user_traits_payment_transaction_id_foreign', 'user_traits_trait_list_id_foreign']);
        });
    }
}
