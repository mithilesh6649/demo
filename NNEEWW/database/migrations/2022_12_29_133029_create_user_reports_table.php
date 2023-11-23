<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_no')->unique();
            $table->unSignedBigInteger('user_id');
            $table->unSignedBigInteger('test_id')->nullable();
            $table->string('document_url')->nullable();
            $table->boolean('read')->default(0)->comment('0|not read  1|readed');
            $table->unSignedBigInteger('uploaded_by')->nullable();
            $table->char('uploaded_by_guard')->nullable();
            $table->enum('document_type', ['1', '2', '3'])->comment('1|health_checkup  2|test_report  3|organ_checkup')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_reports', function (Blueprint $table) {
            $table->dropUnique('report_no');
            $table->dropForeign(['user_report_user_id_foreign', 'user_report_test_id_foreign']);
        });
    }
}
