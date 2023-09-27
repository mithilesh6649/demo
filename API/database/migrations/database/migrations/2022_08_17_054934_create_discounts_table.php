<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount_name')->nullable();
            $table->string('dicount_type')->nullable();
            $table->string('amount')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('discounts');
    }
}
