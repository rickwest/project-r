<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use SoftDeletes;
    use Likeable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'url',
        'from_now',
        'images',
        'liked',
        'likes_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'media'
    ];

    /**
     * The "booting" method of the posts model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('created_at', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }

    /**
     * The user that the post belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The comments on the post.
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Get the absolute url for the post.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('post.show', ['post' => $this], true);
    }

    /**
     * Get the human readable difference of the created at date 'from now'. E.g.'2 days ago'.
     *
     * @return string
     */
    public function getFromNowAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get is post liked by current user.
     *
     * @return bool
     */
    public function getLikedAttribute()
    {
        return $this->liked();
    }

    /**
     * Get the post image urls.
     *
     * @return array|Collection
     */
    public function getImagesAttribute()
    {
        if ($this->hasMedia('images')) {
            return $this->getMedia('images')->map(function ($media) {
                return $media->getUrl();
            });
        }

        return [];
    }

    /**
     * Register media collections for a post.
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('images');
    }
}
