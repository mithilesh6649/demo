<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToGiftCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_cards', function (Blueprint $table) {
             $table->dropColumn(['start_date', 'end_date','price','thumbnail'   ,'card_type']);
             $table->string('title_ar')->nullable()->after('title');
             $table->string('description_ar')->nullable()->after('description');
             $table->integer('card_number')->after('description_ar');
             $table->integer('gift_cards_type_id')->after('card_number');
             $table->integer('user_id')->nullable()->after('gift_cards_type_id');
             $table->string('purchased_by')->nullable()->after('user_id');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gift_cards', function (Blueprint $table) {
            //
        });
    }
}
