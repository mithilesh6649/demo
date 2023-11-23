<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_comments', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('review_id');
            $table->unSignedBigInteger('review_by_id');
            $table->char('review_by_name')->nullable();
            $table->char('review_by_email')->nullable();
            $table->char('review_by_guard', 12);
            $table->float('review');
            $table->mediumText('comment');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_comments', function (Blueprint $table) {
            $table->dropForeign(['review_comments_review_id_foreign']);
        });
    }
}
