<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	*/
	public function up() {
		Schema::create('permission_role', function (Blueprint $table) {
			$table->id();
			$table->foreignId('permission_id')->constrained();
			$table->foreignId('role_id')->constrained();
			$table->boolean('status')->comment('1 => Active , 0 => Incative')->default(1);
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
		Schema::dropIfExists('permission_role');
	}
}
