<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->mediumText('description_en')->nullable();
            $table->mediumText('description_ar')->nullable();     
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('country')->nullable();
            $table->mediumText('address')->nullable(); 
            $table->enum('status', array('1','0' ))->default('1')->comment('1=>active,0=>deactive');
            $table->enum('accepts_pre_order', array('0','1' ))->default('1')->comment('0=>no,1=>yes');
            $table->integer('minimum_order_amount')->nullable();
            $table->time('working_hours_starts_at')->nullable();
            $table->time('working_hours_ends_at')->nullable();
            $table->dateTime('delivery_time')->nullable();
            $table->enum('contact_less_drop_off', array('0','1' ))->default('1')->comment('0=>no,1=>yes');
             $table->enum('live_tracking', array('0','1' ))->default('1')->comment('0=>no,1=>yes');
             $table->string('cuisins')->comment('indian, internation, biryani, chinese')->nullable();
              $table->enum('accepts_stripe', array('0','1' ))->default('1')->comment('0=>no,1=>yes');
              $table->enum('accepts_paypal', array('0','1' ))->default('1')->comment('0=>no,1=>yes');
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
        Schema::dropIfExists('branches');
    }
}

