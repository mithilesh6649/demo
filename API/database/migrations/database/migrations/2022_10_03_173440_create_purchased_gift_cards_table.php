<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedGiftCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_gift_cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->date('date')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('doc_ref_no')->nullable();
            $table->string('card_number')->nullable();
            $table->string('pos_invoice_number')->nullable();
            $table->double('pos_invoice_amount')->nullable();
            $table->double('card_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased_gift_cards');
    }
}
