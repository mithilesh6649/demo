<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_working_hours', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->string('days');
            $table->time('starting_hour');
            $table->time('ending_hour');
            $table->time('break_starting_time')->nullable();
            $table->time('break_ending_time')->nullable();
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
        Schema::dropIfExists('branch_working_hours');
    }
}
