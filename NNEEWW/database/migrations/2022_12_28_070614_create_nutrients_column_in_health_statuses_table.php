<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutrientsColumnInHealthStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
            $table->tinyInteger('total_fats_per_day')->after('goal_id')->nullable();
            $table->tinyInteger('total_carbs_per_day')->after('total_fats_per_day')->nullable();
            $table->tinyInteger('total_protein_per_day')->after('total_carbs_per_day')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_statuses', function (Blueprint $table) {
            $table->dropColumn(['total_fats_per_day', 'total_carbs_per_day', 'total_protein_per_day']);
        });
    }
}
