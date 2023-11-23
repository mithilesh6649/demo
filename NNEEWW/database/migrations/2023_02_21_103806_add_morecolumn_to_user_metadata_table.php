<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorecolumnToUserMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_metadata', function (Blueprint $table) {
            $table->after('user_id',function($table) {

               $table->enum('personal_marital_status', ['single', 'married', 'other'])->nullable(); 
               $table->boolean('personal_bowel_movement')->comment('1|normal  2|constipation 3|diarrhoea 4|irregular')->nullable();
               $table->boolean('personal_smoker')->comment('1|yes  0|No')->nullable();
               $table->boolean('personal_alcohol_consumption')->comment('1|yes  0|No')->nullable();
               $table->boolean('personal_sleep_quality')->comment('1|less then 5hrs  2|5hrs 3|Greater then 5hrs 5|10hrs')->nullable();
               $table->time('personal_usual_wake_up_time')->nullable();
               $table->time('personal_usual_bedtime')->nullable();
               $table->boolean('personal_physical_activity')->comment('Id form Md Dropdown')->nullable();
               $table->longText('personal_other_information')->nullable();

               $table->json('dietary_type_of_diet')->comment('id of diets table')->nullable();
               $table->string('dietary_favorite_food')->comment('Favorite Food')->nullable();
               $table->string('dietary_disliked_food')->comment('Disliked Food')->nullable();
               $table->json('dietary_allergies')->comment('id of allergies'  )->nullable();
               $table->json('dietary_food_intolerance')->comment('id of food_intolerance'  )->nullable();
               $table->string('dietary_nutritional_deficiencies')->nullable();

               $table->boolean('dietary_eating_out_pattern')->comment('1|Daily  2|2-3 times in a week 3|4-6 times in a week 4|Occasionally 5|Never')->nullable();
               $table->string('dietary_supplements_intake')->nullable();
               $table->longText('dietary_other_information')->nullable();

               $table->json('diseases')->comment('id of diseases')->nullable();
               $table->string('medical_medication')->nullable(); 
               $table->longText('personal_history')->nullable();

               $table->longText('medical_family_history')->nullable();

               $table->longText('medical_other_information')->nullable();




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
             $table->dropColumn(['personal_marital_status','personal_bowel_movement','personal_smoker','personal_alcohol_consumption','personal_sleep_quality','personal_usual_wake_up_time','personal_usual_bedtime','personal_physical_activity','personal_other_information','dietary_type_of_diet','dietary_favorite_food','dietary_disliked_food','dietary_allergies','dietary_food_intolerance','dietary_nutritional_deficiencies','dietary_eating_out_pattern','dietary_supplements_intake','dietary_other_information','diseases','medical_medication','personal_history','medical_family_history','medical_other_information']);
        });
    }
}
