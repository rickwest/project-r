<?php

use App\Post;
use App\Profile;
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
        $this->call(UserSeeder::class);

        // Create users.
        $users = factory(\App\User::class, 20)
            ->create()
            ->each(function ($user) {
                // Create a profile for user.
                $user->profile()->save(factory(Profile::class)->make());

                // Create some posts for the user.
                $posts = factory(Post::class, 10)
                    ->create(['user_id' => $user->id])
                    ->each(function ($post) {
//                        $comments = factory(Comment::class, )->create()->each()
                    });

                // Save the posts.
                $user->posts()->saveMany($posts);
            });
    }
}
