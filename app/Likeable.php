<?php

namespace App;

trait Likeable
{
    /**
     * Get all of the model likes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get the number of likes for the model.
     *
     * @return int
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    /**
     * Like the model for the specified user.
     *
     * @param int|null $userId
     * @return void
     */
    public function like(?int $userId = null): void
    {
        $userId = $userId ?? $this->getAuthenticatedUserId();

        $like = $this->likes()->where('user_id', $userId)->withTrashed()->firstOrCreate(['user_id' => $userId]);

        // If like is soft deleted then restore it.
        if ($like->trashed()) {
            $like->restore();
        }
    }

    /**
     * Unlike the model for the specified user.
     *
     * @param int|null $userId
     * @return void
     * @throws \Exception
     */
    public function unlike(?int $userId = null): void
    {
        $userId = $userId ?? $this->getAuthenticatedUserId();

        $like = $this->likes()->where('user_id', $userId)->delete();

//        if ($like) {
//            $like->delete();
//        }
    }

    /**
     * Check if the model is liked by the specified user.
     *
     * @param int|null $userId
     * @return bool
     */
    public function liked(?int $userId = null): bool
    {
        $userId = $userId ?? $this->getAuthenticatedUserId();

        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Helper function that toggles the like on the model for the specified user.
     *
     * @param int|null $userId
     * @return void
     * @throws \Exception
     */
    public function toggleLike(?int $userId = null): void
    {
        $userId = $userId ?? $this->getAuthenticatedUserId();

        $this->liked($userId) ? $this->unlike($userId) : $this->like($userId);
    }

    /**
     *  Used to get a collection of models liked by the specified user.
     *
     * E.g. Post::whereLikedByUser(1)->get();
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int|null $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereLikedByUser(\Illuminate\Database\Eloquent\Builder $query, ?int $userId = null)
    {
        $userId = $userId ?? $this->getAuthenticatedUserId();

        return $query->whereHas('likes', function($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    /**
     * @return int|string|null
     */
    protected function getAuthenticatedUserId()
    {
        return auth()->id();
    }
}
