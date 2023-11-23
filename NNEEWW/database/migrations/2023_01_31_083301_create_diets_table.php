<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diets', function (Blueprint $table) {
               $table->id();
            $table->unSignedBigInteger('diet_category_id');
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->float('amount');
            $table->boolean('status')->comment('0|inactive 1|active')->default('1');
            $table->softDeletes(); 
            $table->timestamps();
             $table->foreign('diet_category_id')->references('id')->on('diet_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('diets',function(Blueprint $table){
            $table->dropForeign(['lists_diet_category_id_foreign']);
            $table->dropIndex(['lists_diet_category_id_index']);
            $table->dropColumn(['diet_category_id','title','description','image','amount','status']);

        });
    }
}
