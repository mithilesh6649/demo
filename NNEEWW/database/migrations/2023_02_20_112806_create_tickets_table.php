<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->char('unique_ticket_id')->unique();
            $table->unSignedBigInteger('ticket_owner_id');
            $table->char('ticket_owner_guard');
            $table->char('title')->nullable();
            $table->text('content')->nullable();
            $table->unSignedBigInteger('status_id');
            $table->char('priority');
            $table->char('ticket_type')->comment('1|organ report  2|support');
            $table->unSignedBigInteger('user_report_id')->nullable();
            $table->char('category');
            $table->unSignedBigInteger('ticket_assigned_to')->nullable();
            $table->char('ticket_assigned_to_guard')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['ticket_owner_id', 'ticket_assigned_to']);
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('CASCADE');
            $table->foreign('user_report_id')->references('id')->on('user_reports')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets', function (Blueprint $table) {
            $table->dropIndex(['ticket_owner_id', 'ticket_assigned_to']);
            $table->dropForeign(['tickets_status_id_foreign', 'tickets_user_report_id_foreign']);
        });
    }
}
