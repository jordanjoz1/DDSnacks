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
            'description' => 'Test description',
            'created_by' => 1,
        ));
        
        Group::create(array(
            'name' => '3rd Floor Garage',
            'description' => '3rd floor description',
            'created_by' => 1,
        ));
	}

}
