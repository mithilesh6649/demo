<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_images', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->nullable();
            $table->string('page_title')->nullable();
            $table->string('sections')->nullable();
            $table->string('image')->nullable();
            $table->integer('image_height')->nullable();
            $table->integer('image_width')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('media_images');
    }
}
