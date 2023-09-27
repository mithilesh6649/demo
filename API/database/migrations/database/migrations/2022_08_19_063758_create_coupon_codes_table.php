<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name');
            $table->mediumText('description');
            $table->string('start_date');
            $table->string('end_date');
            $table->enum('discount_type', ['0','1','2'])->default('1')->comment("0:percentage , 1:amount , 2:item");
            $table->float('discount_amount')->nullable();  
            $table->integer('menu_item_id')->nullable();
            $table->enum('coupon_type', ['0','1'])->default('1')->comment("1:Internal'', 0:External"); 
            $table->float('minimum_order_amount')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('discount_status', ['0','1'])->default('1')->comment("1:Activate'', 0:External");
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
        Schema::dropIfExists('coupon_codes');
    }
}
