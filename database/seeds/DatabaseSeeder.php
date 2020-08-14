<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
         factory(User::class,250)->create();
         factory(Post::class, 1000)->create();
        factory(Comment::class, 5000)->create();
    }
}
