<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

// -city/city_id
// - user_id (nullable)
// - first_name
// - last_name
// - email 
// - phone_number
// - celebration_type
// - date_of_celebration
// - complete_address
// - status (Pending, Completed, Failed, Cancelled, Spam)
// - cencelled_by (nullable)
// - cencellation_date (nullable)

    public function up()
    {
        Schema::create('catrings', function (Blueprint $table) {
 
            $table->id();
            $table->integer('city_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('menu_type')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('celebration_type');
            $table->string('date_of_celebrations');
            $table->string('complete_address');
            $table->string('status')->nullable()->comment('0=>Pending,1=>Completed,2=>Failed,3=>Cancelled,4=>Spam');
            $table->string('cancelled_by')->nullable();
            $table->string('cencellation_date')->nullable();
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
        Schema::dropIfExists('catrings');
    }
}
