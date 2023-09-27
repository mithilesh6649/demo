<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name');
            $table->mediumText('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('offer_type', ['0','1'])->default('1')->comment("0:percentage'', 1:amount'");
            $table->integer('offer_amount');
             $table->enum('status', ['0','1','2'])->default('1')->comment("0:inactive', 1:active' , '2:expire'");
            $table->softDeletes();
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
        Schema::dropIfExists('checkout_offers');
    }
}
