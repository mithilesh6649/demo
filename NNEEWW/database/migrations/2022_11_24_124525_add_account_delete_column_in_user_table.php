<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountDeleteColumnInUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('account_deleted')->after('remember_token')->default(0)->comment('0|not-deleted 1|deleted');
            $table->json('account_deleted_by')->after('account_deleted')->nullable();
            $table->timestamp('account_deleted_at')->after('account_deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['account_deleted', 'account_deleted_by', 'account_deleted_at']);
        });
    }
}
