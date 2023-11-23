<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_trackers', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->string('medicine_name');
            $table->unSignedBigInteger('medicine_type_id')->comment('primary_key of md_dropdowns table');
            $table->tinyInteger('dose_count');
            $table->unSignedBigInteger('serving_unit_id')->comment('primary_key of md_dropdowns table');
            $table->enum('scheduler_type', ['1', '2'])->comment('1|everyday   2|specific day');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->boolean('status')->comment('0|disable reminder   1|enable reminder');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('medicine_type_id')->references('id')->on('md_dropdowns')->onDelete('CASCADE');
            $table->foreign('serving_unit_id')->references('id')->on('md_dropdowns')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_trackers', function (Blueprint $table) {

            $table->dropForeign(['medicine_trackers_user_id_foreign', 'medicine_trackers_medicine_type_id_foreign', 'medicine_trackers_serving_unit_id_foreign']);
        });
    }
}
