<?php

use Illuminate\Database\Seeder;

class CommentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Comment::create([
          'author_id' => rand(1,2),
          'current_text' => str_random(64),
          'edited' => 'no',
          'history' => '{}'
        ]);
    }
}
