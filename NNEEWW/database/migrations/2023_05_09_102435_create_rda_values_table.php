<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRdaValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rda_values', function (Blueprint $table) {
            $table->id();
            $table->char('category');
            $table->tinyInteger('particulars');
            $table->float('energy_ear')->nullable();
            $table->float('protein_ear')->nullable();
            $table->float('protein_rda')->nullable();
            $table->float('dietary_fibre')->nullable();
            $table->float('calcium_ear')->nullable();
            $table->float('calcium_rda')->nullable();
            $table->float('calcium_tul')->nullable();
            $table->float('magnesium_ear')->nullable();
            $table->float('magnesium_rda')->nullable();
            $table->float('magnesium_tul')->nullable();
            $table->float('iron_ear')->nullable();
            $table->float('iron_rda')->nullable();
            $table->float('iron_tul')->nullable();
            $table->float('zinc_ear')->nullable();
            $table->float('zinc_rda')->nullable();
            $table->float('zinc_tul')->nullable();
            $table->float('iodine_ear')->nullable();
            $table->float('iodine_rda')->nullable();
            $table->float('iodine_tul')->nullable();
            $table->float('thiamine_ear')->nullable();
            $table->float('thiamine_rda')->nullable();
            $table->float('riboflavin_ear')->nullable();
            $table->float('riboflavin_rda')->nullable();
            $table->float('niacin_ear')->nullable();
            $table->float('niacin_rda')->nullable();
            $table->float('niacin_tul')->nullable();
            $table->float('vitamin_b_6_ear')->nullable();
            $table->float('vitamin_b_6_rda')->nullable();
            $table->float('vitamin_b_6_tul')->nullable();
            $table->float('folate_ear')->nullable();
            $table->float('folate_rda')->nullable();
            $table->float('folate_tul')->nullable();
            $table->float('vitamin_b_12_ear')->nullable();
            $table->float('vitamin_b_12_rda')->nullable();
            $table->float('vitamin_c_ear')->nullable();
            $table->float('vitamin_c_rda')->nullable();
            $table->float('vitamin_c_tul')->nullable();
            $table->float('vitamin_a_ear')->nullable();
            $table->float('vitamin_a_rda')->nullable();
            $table->float('vitamin_a_tul')->nullable();
            $table->float('vitamin_d_ear')->nullable();
            $table->float('vitamin_d_rda')->nullable();
            $table->float('vitamin_d_tul')->nullable();
            $table->float('selenuim')->nullable();
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
        Schema::dropIfExists('rda_values');
    }
}
