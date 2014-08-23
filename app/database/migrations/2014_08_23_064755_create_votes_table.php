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
        
        Schema::table('votes', function($table) {
            $table->foreign('snack_id')->references('id')->on('snacks');
            $table->foreign('user_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('votes');
	}

}
