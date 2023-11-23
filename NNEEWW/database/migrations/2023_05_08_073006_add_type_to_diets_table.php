<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diets', function (Blueprint $table) {
             $table->unSignedBigInteger('diet_category_id')->nullable()->change(); 
              $table->string('image')->nullable()->change();
         $table->tinyInteger('type')->after('diet_category_id')->comment('1|Diets 2|Plans')->default('1')->nullable();
         $table->float('discount')->comment('discount in %')->after('amount')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diets', function (Blueprint $table) {
            $table->dropColumn(['type','discount']);
        });
    }
}
