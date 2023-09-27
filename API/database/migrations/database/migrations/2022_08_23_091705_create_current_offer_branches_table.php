<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentOfferBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_offer_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('current_offer_id');
            $table->foreign('current_offer_id')->references('id')->on('current_offers')->onDelete('cascade');
            $table->integer('branch_id')->nullable();
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
        Schema::dropIfExists('current_offer_branches');
    }
}
