<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('person_name')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->string('doc_ref_no')->nullable();
            $table->string('voucher_number')->nullable();
            $table->integer('car_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->string('driven_km')->nullable();
            $table->string('fuel')->nullable();
            $table->string('report_type')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->nullable();
            $table->double('amount')->nullable();
            $table->date('report_date')->nullable();
            $table->integer('petrol_pump_id')->nullable();
            $table->time('fuel_time')->nullable();
            $table->date('petrol_slip_date')->nullable();
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
        Schema::dropIfExists('maintenance_reports');
    }
}
