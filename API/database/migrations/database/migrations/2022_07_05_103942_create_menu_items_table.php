<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id')->nullable();
            $table->integer('sub_cat_id')->nullable();
            $table->string('item_name_en')->nullable();
            $table->string('item_name_ar')->nullable();
            $table->mediumText('description_en')->nullable();
            $table->mediumText('description_ar')->nullable();
            $table->string('key_ingredients')->nullable(); 
            $table->string('served_with')->nullable(); 
            $table->integer('price')->nullable(); 
            $table->string('thumbnail')->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}
