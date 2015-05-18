<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('comments', function($table) {
            $table->foreign('snack_id')
            	->references('id')
            	->on('snacks')
            	->onDelete('no action');
            $table->foreign('user_id')
            	->references('id')
            	->on('users')
            	->onDelete('no action');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('comments', function($table) {
            $table->dropForeign('comments_snack_id_foreign');
            $table->dropForeign('comments_user_id_foreign');
        });
	}

}
