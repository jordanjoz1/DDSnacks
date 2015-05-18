<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->integer('created_by')->unsigned();
            $table->boolean('editable')->default(true);
            $table->boolean('global')->default(false);
            $table->timestamps();
		});
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('groups');
	}

}
