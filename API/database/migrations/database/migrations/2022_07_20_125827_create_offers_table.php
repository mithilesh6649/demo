<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name');
            $table->string('promocode');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('discount_type', ['0','1'])->default('1')->comment("0:percentage'', 1:amount'");
            $table->integer('discount_amount');
            $table->string('minimum_order')->nullable();
            $table->string('minimum_order_amount')->nullable();
            $table->string('maximum_order')->nullable();
            $table->string('maximum_order_amount')->nullable();
            $table->string('every_order')->nullable();
            $table->string('first_order')->nullable();
            $table->string('picture_one');
            $table->string('picture_two');
            $table->mediumText('description')->nullable();
            $table->mediumText('terms_and_conditions')->nullable();
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
        Schema::dropIfExists('offers');
    }
} 
