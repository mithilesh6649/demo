<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalties', function (Blueprint $table) {
            $table->id();
            $table->string('loyalty_type')->nullable();
            $table->string('loyalty_image')->nullable();
            $table->integer('applicable_from')->nullable();
            $table->integer('applicable_to')->nullable(); 
            $table->string('amount_text')->nullable();
            $table->integer('amount')->comment('in percentage')->nullable();
            $table->string('redeem_text')->nullable();
            $table->integer('redeem_amount')->comment('in percentage')->nullable();;
            $table->tinyInteger('loyalty_slug')->comment('1=>for bronze,sliver,gold,0=>signup')->default(1);
            $table->tinyInteger('status')->comment('1=>enabled,0=>disabled')->default(1);
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
        Schema::dropIfExists('loyalties');
    }
}
