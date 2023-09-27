<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_blocks', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->integer('block_id');
            $table->enum('status', ['0','1'])->default('1')->comment("0:inactive', 1:active'");
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
        Schema::dropIfExists('city_blocks');
    }
}
