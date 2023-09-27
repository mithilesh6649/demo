<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchMenuCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_menu_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('menu_category_id');
            $table->tinyInteger('status')->comment('0=>inactive,1=>active')->default(1); 
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
        Schema::dropIfExists('branch_menu_categories');
    }
}
