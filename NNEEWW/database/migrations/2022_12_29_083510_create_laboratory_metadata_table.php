<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoryMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_metadata', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('laboratory_id');
            $table->char('open_time')->nullable();
            $table->char('close_time')->nullable();
            $table->boolean('is_partner')->comment('0|not partner  1|partner')->nullable();
            $table->float('charges')->nullable();
            $table->string('address')->nullable();
            $table->char('city')->nullable();
            $table->char('state')->nullable();
            $table->boolean('status')->comment('0|inactive  1|active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratory_metadata', function (Blueprint $table) {
            $table->dropForeign('laboratory_metadata_id_foreign');
        });
    }
}
