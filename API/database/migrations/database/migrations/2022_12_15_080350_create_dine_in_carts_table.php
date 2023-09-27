<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDineInCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dine_in_carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('table_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->bigInteger('menu_item_id')->nullable();
            $table->tinyInteger('quantity')->nullable();
            $table->double('menu_item_price')->nullable();
            $table->string('status')->default(1)->comment('1=>active , 2=>completed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dine_in_carts');
    }
}
