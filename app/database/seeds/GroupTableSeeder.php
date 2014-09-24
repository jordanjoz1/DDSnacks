<?php

class GroupTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('groups')->delete();
        
        Group::create(array(
            'name' => '8th Floor Engineering',
            'description' => '',
            'created_by' => 1,
        ));

        Group::create(array(
            'name' => '8th Floor Kitchen',
            'description' => '',
            'created_by' => 1,
        ));
        
        Group::create(array(
            'name' => '3rd Floor Garage',
            'description' => '',
            'created_by' => 1,
        ));


	}

}
