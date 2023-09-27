<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_type')->nullable();
            $table->date('date')->nullable();
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('category_id')->nullable();
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
        Schema::dropIfExists('order_sessions');
    }
}
