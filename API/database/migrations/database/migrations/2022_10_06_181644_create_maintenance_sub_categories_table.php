<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id')->nullable();
            $table->string('sub_cat_name')->nullable();
            $table->tinyInteger('status')->comment('1=>active,0=>inactive')->default(1);
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
        Schema::dropIfExists('maintenance_sub_categories');
    }
}
