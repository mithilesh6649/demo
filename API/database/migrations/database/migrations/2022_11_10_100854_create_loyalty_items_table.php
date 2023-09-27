<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_item_id')->nullable();
            $table->double('loyalty_points')->nullable();
            $table->tinyInteger('status')->default(1)->comment('(0=>Inactive,1=>Active)');
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
        Schema::dropIfExists('loyalty_items');
    }
}
