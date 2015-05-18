<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    	Schema::create('votes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('snack_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('value')->default(0);
            $table->timestamps();
            $table->unique( array('snack_id','user_id') );
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
		Schema::dropIfExists('votes');
	}

}
