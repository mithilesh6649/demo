<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineSchedulers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_schedulers', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('medicine_tracker_id');
            $table->tinyInteger('week_days');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('medicine_tracker_id')->references('id')->on('medicine_trackers')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_schedulers', function (Blueprint $table) {
            $table->dropForeign('medicine_schedulers_medicine_tracker_id_foreign');
        });
    }
}
