<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_locked');
            $table->dropColumn('account_locked_at');
            $table->dropColumn('account_deleted');
            $table->dropColumn('account_deleted_by');
            $table->dropColumn('account_deleted_at');
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
            $table->boolean('account_locked')->after('login_with')->nullable();
            $table->timestamp('account_locked_at')->after('account_locked')->nullable();
            $table->boolean('account_deleted')->after('remember_token')->default(0)->comment('0|not-deleted 1|deleted');
            $table->json('account_deleted_by')->after('account_deleted')->nullable();
            $table->timestamp('account_deleted_at')->after('account_deleted_by')->nullable();
        });
    }
}
