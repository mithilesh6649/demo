<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_openings', function (Blueprint $table) {
            $table->id();
             $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('employee_type')->comment('1|Full Time 0|Part Time')->default('1');
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
        Schema::dropIfExists('current_openings');
    }
}
