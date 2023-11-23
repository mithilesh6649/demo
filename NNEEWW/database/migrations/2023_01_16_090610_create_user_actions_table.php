<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_actions', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('user_id');
            $table->enum('user_guard', ['users', 'web_users']);
            $table->unSignedBigInteger('status_id');
            $table->unSignedBigInteger('action_by');
            $table->string('action_reason');
            $table->datetime('action_time');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_actions', function (Blueprint $table) {

            $table->dropForeign('user_actions_status_id_foreign');
        });
    }
}
