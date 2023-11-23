<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('recipe_category_id');
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->integer('time');
            $table->integer('kilocalorie'); 
            $table->integer('serving');
            $table->json('ingredients');
            $table->json('instructions');
            $table->json('tags')->nullable();
             $table->boolean('status')->comment('0|inactive 1|active')->default('1'); 
            $table->timestamps();
             $table->foreign('recipe_category_id')->references('id')->on('recipe_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes',function(Blueprint $table){
            $table->dropForeign(['lists_recipe_category_id_foreign']);
            $table->dropIndex(['lists_recipe_category_id_index']);
            $table->dropColumn(['recipe_category_id','title','description','image','time','kilocalorie','serve','ingredient','instruction','tag']);

        });
    }
}
