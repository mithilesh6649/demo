<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_cars', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('car_id');
            $table->tinyInteger('status')->default(1)->comment('1=>active,0=>inactive');  
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
        Schema::dropIfExists('branch_cars');
    }
}
