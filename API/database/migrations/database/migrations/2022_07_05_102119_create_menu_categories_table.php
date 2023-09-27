<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
             $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->mediumText('description_en')->nullable();
            $table->mediumText('description_ar')->nullable();
            $table->string('image_name')->nullable();
            $table->enum('status', array('1','0' ))->default('1')->comment('1=>active,0=>deactive');
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
        Schema::dropIfExists('menu_categories');
    }
}
