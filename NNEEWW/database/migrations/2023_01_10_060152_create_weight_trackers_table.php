<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_trackers', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->float('weight')->nullable();
            $table->char('weight_unit')->nullable();
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
        Schema::dropIfExists('weight_trackers', function (Blueprint $table) {
            $table->dropForeign('weight_trackers_user_id_foreign');
        });
    }
}
