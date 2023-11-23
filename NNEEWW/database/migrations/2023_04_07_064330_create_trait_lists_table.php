<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraitListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trait_lists', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('trait_category_id');
            $table->string('title');
            $table->tinyInteger('suitable_for')->comment('0|all or default 1|Men Only  2|Women Only 3|Pediatric')->default('0');
            $table->boolean('status')->comment('0|inactive 1|active')->default('1');
            $table->timestamps();
            $table->foreign('trait_category_id')->references('id')->on('trait_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trait_lists',function($table){
            $table->dropForeign(['lists_trait_category_id_foreign']);
        });
    }
}
