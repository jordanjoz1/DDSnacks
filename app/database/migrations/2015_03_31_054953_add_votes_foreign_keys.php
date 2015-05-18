<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVotesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // Schema::table('votes', function($table) {
        //     $table->foreign('snack_id')->references('id')->on('snacks');
        //     $table->foreign('user_id')->references('id')->on('users');
        // });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // Schema::table('votes', function($table) {
        //     $table->dropForeign('votes_snack_id_foreign');
        //     $table->dropForeign('votes_user_id_foreign');
        // });
	}

}
