<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoryTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_tests', function (Blueprint $table) {
            $table->unSignedBigInteger('laboratory_id');
            $table->unSignedBigInteger('test_id');

            $table->foreign('laboratory_id')->references('id')->on('laboratories')->onDelete('CASCADE');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratory_tests', function (Blueprint $table) {
            $table->dropForeign(['laboratory_id_foreign', 'test_id_foreign']);
        });
    }
}
