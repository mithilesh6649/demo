<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up() {
		Schema::create('pages', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('section');
			$table->enum('device_type', ['web', 'mobile'])->default('web');
			$table->longText('content');
			$table->integer('status')->comment('1 => Active , 0 => Incative')->default(1);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	*/
	public function down() {
		Schema::dropIfExists('pages');
	}
}
