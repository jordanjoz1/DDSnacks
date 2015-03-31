<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('snacks', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('group_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->timestamps();
            $table->unique( array('name','group_id') );
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('snacks');
	}

}
