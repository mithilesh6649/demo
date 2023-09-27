<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {

        Schema::create('banner_images', function (Blueprint $table) {
            $table->id();
            $table->string('page_name');
            $table->string('banner');
            $table->integer('type')->nullable()->comment('0=>single,1=>slider');;
            $table->boolean('status')->default(1)->comment('0=>active,1=>deactive');;
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
        Schema::dropIfExists('banner_images');
    }
}
