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
        
        Schema::table('groups', function($table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('groups');
	}

}
