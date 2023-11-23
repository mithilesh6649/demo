<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketAssignedToWebUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_assigned_to_web_users', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('ticket_id')->nullable();
            $table->unSignedBigInteger('gena_health_user_id');
            $table->char('gena_health_user_guard');
            $table->date('ticket_assigned_date')->nullable();
            $table->date('ticket_revoke_date')->nullable();
            $table->boolean('is_blocked')->default('0');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_assigned_to_web_users',function(Blueprint $table){
            $table->dropForeign(['ticket_assigned_to_web_users_ticket_id_foreign']);
        });
    }
}
