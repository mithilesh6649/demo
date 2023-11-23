<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add24hrsrelatedcolumnToUserMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_metadata', function (Blueprint $table) {
              $table->after('medical_other_information',function($table){
                $table->json('family_medical_history')->nullable();
                $table->longText('early_morning_recall')->nullable();
                $table->longText('breakfast_recall')->nullable();
                $table->longText('lunch_recall')->nullable();
                $table->longText('mid_morning_recall')->nullable();
                $table->longText('evening_recall')->nullable();
                $table->longText('dinner_recall')->nullable();
                $table->longText('post_dinner_recall')->nullable();
              }); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_metadata', function (Blueprint $table) {
            $table->dropColumn(['family_medical_history','early_morning_recall','breakfast_recall','lunch_recall','mid_morning_recall','evening_recall','dinner_recall','post_dinner_recall']);
        });
    }
}
