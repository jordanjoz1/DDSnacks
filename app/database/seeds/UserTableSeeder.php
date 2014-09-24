<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
        
        User::create(array(
            'email' => 'jordan@doubledutch.me',
            'password' => Hash::make('321')
        ));
	}

}
