<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffpromotionhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_promotion_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->float('earlier_point',8,3)->nullable();
            $table->float('new_point',8,3)->nullable();
            $table->foreign('branch_id')->references('id')->on('branches'); 
            $table->foreign('staff_id')->references('id')->on('staff'); 
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
        Schema::dropIfExists('staff_promotion_histories');
    }
}
