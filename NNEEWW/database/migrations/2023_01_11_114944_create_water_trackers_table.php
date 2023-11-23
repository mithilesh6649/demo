<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaterTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('water_trackers', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->tinyInteger('glass_count');
            $table->char('unit', 4);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('water_trackers', function (Blueprint $table) {
            $table->dropForeign('water_trackers_user_id_foreign');
        });
    }
}
