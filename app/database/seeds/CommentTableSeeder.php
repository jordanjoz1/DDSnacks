<?php

class CommentTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        Comment::create(array(
            'snack_id' => 1,
            'user_id' => 1,
            'comment' => 'love these things! so great :D',
        ));

        Comment::create(array(
            'snack_id' => 1,
            'user_id' => 2,
            'comment' => 'Seriously? they are the worst!',
        ));

        Comment::create(array(
            'snack_id' => 1,
            'user_id' => 3,
            'comment' => '*gasp* take that back!',
        ));

        Comment::create(array(
            'snack_id' => 1,
            'user_id' => 2,
            'comment' => 'NEVERRRRRRRR',
        ));

        Comment::create(array(
            'snack_id' => 2,
            'user_id' => 1,
            'comment' => 'I could eat this all day',
        ));
    }

}
