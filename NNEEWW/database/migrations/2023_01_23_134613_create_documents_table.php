<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('document_owner_id');
            $table->char('document_owner_guard');
            $table->string('document_url');
            $table->unSignedBigInteger('document_status')->comment('primary key of statuses table');
            $table->unSignedBigInteger('document_action_by')->comment('primary key of admins table')->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('document_status')->references('id')->on('statuses')->onDelete('CASCADE');
            $table->foreign('document_action_by')->references('id')->on('admins')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents', function (Blueprint $table) {
            $table->dropForeign('documents_document_action_by_foreign');
        });
    }
}
