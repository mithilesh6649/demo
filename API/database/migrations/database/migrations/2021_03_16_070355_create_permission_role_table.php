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
			$table->integer('permission_id');
			$table->integer('role_id');
			$table->tinyInteger('status')->comment('0=>inactive,1=>active')->default(1);
			$table->bigInteger('created_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
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
