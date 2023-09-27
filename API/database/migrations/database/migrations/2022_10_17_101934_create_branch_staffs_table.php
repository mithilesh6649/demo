<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('staff_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_tip_pending')->default(0)->comment('0=>no,1=>yes');
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
        Schema::dropIfExists('branch_staffs');
    }
}
