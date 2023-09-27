<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyPettyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_petty_expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->string('doc_ref_no')->nullable();
            $table->string('voucher_number')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->nullable();
            $table->float('amount');
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
        Schema::dropIfExists('daily_petty_expenses');
    }
}
