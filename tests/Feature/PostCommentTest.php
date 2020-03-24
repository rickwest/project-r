<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostCommentTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthenticatedUserCanFetchPosts()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $comments = factory(Comment::class, 5)->create(['post_id' => $post->id]);

        $this->actingAs($user);

        $response = $this->getJson('/post/' . $post->id . '/comments');
        $response->assertOk();
        $this->assertCount(5, $response->json());
    }

    public function testAuthenticatedUserCanViewSinglePostComments()
    {
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->create(['post_id' => $post->id]);
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/post/' . $post->id);
        $response->assertOk();
        $response->assertSee($comment->body);
    }
}
