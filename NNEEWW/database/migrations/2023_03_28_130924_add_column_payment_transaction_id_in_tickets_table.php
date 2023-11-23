<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPaymentTransactionIdInTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unSignedBigInteger('payment_transation_id')->after('unique_ticket_id')->nullable();

            $table->foreign('payment_transation_id')->references('id')->on('payment_transactions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropforeign(['tickets_payment_transation_id_foreign']);
            $table->dropColumn('payment_transation_id');
        });
    }
}
