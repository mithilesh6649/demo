<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthStatusTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * id (Primary Key)

     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('height')->nullable();
            $table->char('height_unit')->nullable();
            $table->integer('health_activity_id')->nullable();
            $table->float('weight')->nullable();
            $table->char('weight_unit')->nullable();
            $table->integer('age')->nullable();
            $table->float('bmi')->nullable();
            $table->longText('bio')->nullable();
            $table->integer('disease_id')->nullable();
            $table->float('target_weight')->nullable();
            $table->char('target_weight_unit')->nullable();
            $table->float('daily_calories_intake')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_statuses');
    }
}
