<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->nullable();
            $table->string('page_title')->nullable();
            $table->string('image_slug')->nullable();
            $table->string('section')->nullable();
            $table->string('image')->nullable();
            $table->enum('device_type', ['web', 'mobile'])->default('web');
            $table->integer('status')->comment('1 => Active , 0 => Incative')->default(1);
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
        Schema::dropIfExists('media');
    }
}
