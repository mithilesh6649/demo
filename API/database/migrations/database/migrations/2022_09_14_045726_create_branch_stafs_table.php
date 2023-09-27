<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchStafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_stafs', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('designation_id');
            $table->string('staff_code')->nullable();
            $table->string('staff_name')->nullable();
            $table->string('point')->nullable();
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
        Schema::dropIfExists('branch_stafs');
    }
}
