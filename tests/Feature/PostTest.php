<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function testAuthenticatedUserCanFetchPosts()
    {
        $posts = factory(Post::class, 10)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->getJson('/posts');
        $response->assertOk();
        $this->assertCount(10, $response->json('data'));
    }

    public function testAuthenticatedUserCanViewSinglePost()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->get('/post/' . $post->id);
        $response->assertOk();
        $response->assertSee($post->title);
    }

    public function testAuthenticatedUserCanViewSinglePostReplies()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create(['post_id' => $post->id]);

        $this->actingAs($user);

        $response = $this->get('/post/' . $post->id);
        $response->assertOk();
        $response->assertSee($comment->body);
    }

    public function testPostOwnerCanDeletePost()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $this->assertDatabaseHas('posts', ['id' => $post->id,]);

        $response = $this->deleteJson('/post/' . $post->id);

        $response->assertStatus(204);
        $this->assertSoftDeleted('posts', ['id' => $post->id,]);
    }

    public function testNonPostOwnerCannotDeletePost()
    {
        $owner = factory(User::class)->create();
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['user_id' => $owner->id]);

        $this->actingAs($user);

        $this->assertDatabaseHas('posts', ['id' => $post->id,]);

        $response = $this->deleteJson('/post/' . $post->id);

        $response->assertStatus(403);
        $this->assertDatabaseHas('posts', ['id' => $post->id,]);
    }
}
