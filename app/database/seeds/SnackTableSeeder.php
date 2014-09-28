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
            'group_id' => 1,
            'created_by' => 1,
            'upvotes' => 3,
            'downvotes' => 1,
        ));
        
        Snack::create(array(
            'name' => 'Beef jerky',
            'description' => 'for Greg',
            'created_by' => 1,
            'group_id' => 2,
        ));

        Snack::create(array(
            'name' => 'Odwalla',
            'created_by' => 1,
            'group_id' => 1,
            'upvotes' => 11,
            'downvotes' => 1,
        ));


        Snack::create(array(
            'name' => 'Coconut water',
            'created_by' => 1,
            'group_id' => 1,
            'upvotes' => 5,
            'downvotes' => 5,
        ));

        Snack::create(array(
            'name' => 'Salt and vinegar chips',
            'created_by' => 2,
            'group_id' => 1,
            'upvotes' => 9,
            'downvotes' => 0,
        ));
	}

}
