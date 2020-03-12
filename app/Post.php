<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'images',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'url',
    ];

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('posts.show', ['post' => $this], true);
    }

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
     * The user that the posts belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
