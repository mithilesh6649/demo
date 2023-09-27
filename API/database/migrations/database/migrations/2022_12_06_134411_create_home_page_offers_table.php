<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_name');
            $table->mediumText('description')->nullable();
            $table->integer('offer_item_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('discount_type', ['1'])->default('1')->comment("'1:Item'");
            $table->string('regular_image')->nullable();
            $table->string('pop_up_image')->nullable();
            $table->enum('pop_up_image_status', ['0','1'])->default('1')->comment("0:inactive', 1:active'");
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
        Schema::dropIfExists('home_page_offers');
    }
}
