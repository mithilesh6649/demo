<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_managers', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('user_id')->nullable()->comment('user id means branch  managers id');
            $table->dateTime('in_sesssion')->nullable();
            $table->dateTime('out_sesssion')->nullable();
            $table->enum('status',['1','0'])->default('1')->comment("1=>active ,0=>deactive  ")->nullable();
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
        Schema::dropIfExists('branch_managers');
    }
}

