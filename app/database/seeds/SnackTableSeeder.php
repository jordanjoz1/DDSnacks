<?php

class SnackTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('snacks')->delete();
        
        Snack::create(array(
            'name' => 'Oatmeal',
            'description' => 'best breakfast food',
            'created_by' => 1,
            'upvotes' => 3,
            'downvotes' => 1,
        ));
        
        Snack::create(array(
            'name' => 'Beef jerky',
            'description' => 'for Greg',
            'created_by' => 1,
        ));
	}

}
