<?php

use App\Comment;
use App\Like;
use App\Post;
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
                // Create some posts for the user.
                $posts = factory(Post::class, rand(1, 10))
                    ->create(['user_id' => $user->id])
                    ->each(function ($post) {
                        // Randomly add some images to posts
                        if (rand(0, 1)) {
                            $post
                                ->addMediaFromUrl('https://projectr.s3.eu-west-2.amazonaws.com/demo/posts/'. rand(1, 20) .'.jpg')
                                ->toMediaCollection('images');
                        };
                        // Randomly add some comments
                        if (rand(1, 0)) {
                            factory(Comment::class, rand(0, 4))->create(['post_id' => $post->id])->each(function ($comment) {
                                if (rand(1, 0)) {
                                    factory(Like::class, rand(0, 10))->create([
                                        'likeable_id' => $comment->id,
                                        'likeable_type' => Comment::class,
                                    ]);
                                }
                            });
                        }
                        if (rand(1, 0)) {
                            factory(Like::class, rand(0, 20))->create([
                                'likeable_id' => $post->id,
                                'likeable_type' => Post::class,
                            ]);
                        }
                    });

                // Save the posts.
                $user->posts()->saveMany($posts);
            });
    }
}
