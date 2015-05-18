<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSnacksForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Schema::table('snacks', function($table) {
        //     $table->foreign('group_id')
        //     	->references('id')
        //     	->on('groups')
        //     	->onDelete('no action');
        //     $table->foreign('created_by')
        //     	->references('id')
        //     	->on('users')
        //     	->onDelete('no action');
        // });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // Schema::table('snacks', function($table) {
        //     $table->dropForeign('snacks_group_id_foreign');
        //     $table->dropForeign('snacks_created_by_foreign');
        // });
	}

}
