<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraitMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trait_maps', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('trait_category_id');
            $table->unSignedBigInteger('trait_list_id');
            $table->timestamps();
            $table->foreign('trait_category_id')->references('id')->on('trait_categories')->onDelete('cascade');
            $table->foreign('trait_list_id')->references('id')->on('trait_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trait_maps',function(){
            $table->dropForeign(['trait_maps_trait_category_id_foreign','trait_maps_trait_list_id_foreign']);
        });
    }
}
