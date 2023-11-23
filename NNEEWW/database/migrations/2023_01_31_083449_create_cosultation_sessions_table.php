<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCosultationSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultant_sessions', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('consultant_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->char('country_code', 4)->nullable();
            $table->integer('contact')->nullable();
            $table->string('city')->nullable();
            $table->text('additional_comment')->nullable();
            $table->timestamps();

            $table->foreign('consultant_id')->references('id')->on('consultants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultant_sessions', function (Blueprint $table) {

            $table->dropForeign('consultant_sessions_consultant_id_foreign');
        });
    }
}
