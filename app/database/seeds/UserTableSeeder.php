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
            'password' => Hash::make('321'),
            'ddID' => 1,
            'name' => "Jordan Jozwiak"
        ));

        User::create(array(
            'email' => 'test1@doubledutch.me',
            'password' => Hash::make('321'),
            'ddID' => 2,
            'name' => "Test 2"
        ));

        User::create(array(
            'email' => 'test3@doubledutch.me',
            'password' => Hash::make('321'),
            'ddID' => 3,
            'name' => "Test 3"
        ));
	}

}
