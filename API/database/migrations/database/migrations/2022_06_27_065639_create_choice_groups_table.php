<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoiceGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choice_groups', function (Blueprint $table) {
             $table->id();
            $table->string('menu_item_id')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('mendatory_choice_count')->nullable();
            $table->string('total_choice_count')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('choice_groups');
    }
}
