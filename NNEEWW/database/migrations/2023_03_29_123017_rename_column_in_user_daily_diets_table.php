<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnInUserDailyDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->renameColumn('total_recommended_calorie', 'total_calorie_intake');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_daily_diets', function (Blueprint $table) {
            $table->renameColumn('total_calorie_intake', 'total_recommended_calorie');
        });
    }
}
