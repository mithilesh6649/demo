<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorNameAndReviewerNameToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
             $table->dropColumn(['author_id','reviewer_id']);
             $table->string('author_name')->nullable()->after('id');
             $table->string('reviewer_name')->nullable()->after('author_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
             $table->dropColumn(['author_name','reviewer_name']);
        });
    }
}
