<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyalityLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyality_levels', function (Blueprint $table) {
            $table->id();
            $table->string('loyalty_name');
            $table->mediumText('loyalty_description')->nullable();
            $table->integer('points_from')->nullable();
            $table->integer('points_to')->nullable();
            $table->integer('regular_items_points')->nullable();
            $table->integer('offers_items_points')->nullable();
            $table->integer('events_points')->nullable()->comment('for birthday, sign_up , online order , dine_in based on rewards_programm'); 
            $table->integer('events_points_expiry')->nullable()->comment('for birthday , sign_up , in days'); 
            $table->integer('minimun_order_amount')->nullable()->comment('for online_order , dine_in');  
            
            $table->integer('register_bonus_newuser')->nullable();
            $table->integer('bonus_active_newuser')->nullable();
            
            $table->string('rewards_programm');
            $table->tinyInteger('status')->comment('1=>enabled,0=>disabled')->default(1); 
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
        Schema::dropIfExists('loyality_levels');
    }
}
