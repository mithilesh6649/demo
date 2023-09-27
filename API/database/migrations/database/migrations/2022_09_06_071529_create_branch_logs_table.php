<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('user_id')->comment('user id means branch managers id')->nullable();
            $table->dateTime('in_session')->nullable();
            $table->dateTime('out_session')->nullable();
            $table->string('description')->nullable();
            $table->string('status')->comment("1=>online ,0=>offline")->default('0')->nullable();
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
        Schema::dropIfExists('branch_logs');
    }
}
