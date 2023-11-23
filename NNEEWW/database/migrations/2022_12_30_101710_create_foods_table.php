<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->char('edmam_food_id', 100)->nullable();
            $table->string('image')->nullable();
            $table->char('brand_name', 100)->nullable();
            $table->char('brand_description', 100)->nullable();
            $table->char('slug', 100)->nullable();
            $table->tinyInteger('serving_size')->nullable();
            $table->float('serving_type')->nullable();
            $table->float('serving_size_in_gram')->nullable();
            $table->tinyInteger('serving_container')->nullable();
            $table->float('calories')->nullable();
            $table->float('total_fat')->nullable();
            $table->float('saturated_fat')->nullable();
            $table->float('polyunsaturated_fat')->nullable();
            $table->float('monounsaturated_fat')->nullable();
            $table->float('trans_fat')->nullable();
            $table->float('cholesterol')->nullable();
            $table->float('sodium')->nullable();
            $table->float('potassium')->nullable();
            $table->float('total_carbohydrate')->nullable();
            $table->float('sugar')->nullable();
            $table->float('added_sugar')->nullable();
            $table->float('sugar_alcohol')->nullable();
            $table->float('protein')->nullable();
            $table->float('vitamin_a')->nullable();
            $table->float('vitamin_b_6')->nullable();
            $table->float('vitamin_b_12')->nullable();
            $table->float('vitamin_c')->nullable();
            $table->float('vitamin_d')->nullable();
            $table->float('calcium')->nullable();
            $table->float('iron')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['edmam_food_id', 'brand_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods', function (Blueprint $table) {
            $table->dropIndex(['edmam_food_id', 'brand_name']);
        });
    }
}
