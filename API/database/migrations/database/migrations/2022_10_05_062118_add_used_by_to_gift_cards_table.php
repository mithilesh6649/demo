<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsedByToGiftCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::table('gift_cards', function (Blueprint $table) {
             $table->tinyInteger('is_gift_card_used')->default(0)->comment('1=>used,0=>unused')->after('gift_cards_type_id');
             $table->string('title')->nullable()->change();
             $table->dropColumn('user_id');
             $table->dropColumn('purchased_by');  
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
