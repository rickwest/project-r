<?php

namespace Tests\Feature;

use App\Comment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CommentLikesTest extends TestCase
{
    use DatabaseMigrations;

    public function testGuestUserCannotLikeComment()
    {
        $comment = factory(Comment::class)->create();

        $response = $this->putJson("comment/{$comment->id}/like");

        $response->assertStatus(401);
    }

    public function testAuthenticatedUserCanLikeComment()
    {
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create();

        $this->actingAs($user);

        $response = $this->putJson("comment/{$comment->id}/like");

        $response->assertStatus(200);
        $this->assertCount(1, $comment->likes);
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $comment->id,
            'likeable_type' => Comment::class,
        ]);
    }

    public function testAuthenticatedUserCanToggleCommentLike()
    {
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create();

        $this->actingAs($user);

        $expectedData = [
            'user_id' => $user->id,
            'likeable_id' => $comment->id,
            'likeable_type' => Comment::class,
        ];

        // Likes comment
        $response = $this->putJson("comment/{$comment->id}/like");
        $response->assertOk();

        $this->assertCount(1, $comment->likes);
        $this->assertDatabaseHas('likes', $expectedData);

        // Unlikes comment
        $response = $this->putJson("comment/{$comment->id}/like");
        $response->assertOk();

        $comment->refresh();

        $this->assertCount(0, $comment->likes);
        $this->assertSoftDeleted('likes', $expectedData);

        // Likes again
        $response = $this->putJson("comment/{$comment->id}/like");
        $response->assertOk();

        $comment->refresh();

        $this->assertCount(1, $comment->likes);
        $this->assertDatabaseHas('likes', $expectedData);
    }

    public function testCorrectCommentLikeCount()
    {
        $users = factory(User::class, 10)->create();
        $comment = factory(Comment::class)->create();

        $users->map(function ($user) use ($comment) {
            $this->actingAs($user);
            $response = $this->putJson("comment/{$comment->id}/like");
            $response->assertOk();
        });

        $this->assertEquals(10, $comment->likesCount);

        // Unlike a comment
        $this->actingAs($users->first());
        $response = $this->putJson("comment/{$comment->id}/like");
        $response->assertOk();

        $this->assertEquals(9, $comment->likesCount);
    }
}
