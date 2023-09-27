<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfferTypeToHomePageOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_page_offers', function (Blueprint $table) {
          $table->dropColumn('discount_type');  
          $table->enum('offer_type', ['0','1'])->default('1')->comment("0:Ads',1:Offer'")->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_page_offers', function (Blueprint $table) {
              $table->dropColumn('offer_type');
        });
    }
}
