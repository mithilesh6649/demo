<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMostSellingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('most_selling_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_item_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('(0=>Inactive,1=>Active)');
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
        Schema::dropIfExists('most_selling_items');
    }
}
