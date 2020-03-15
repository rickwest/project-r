<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Profile extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'bio',
        'location',
        'occupation',
    ];

    /**
     * The user that the profile belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string|null
     */
    public function getAvatarAttribute()
    {
        if ($this->hasMedia('avatars')) {
            $media = $this->getMedia('avatars')->last();

            return $media->getUrl('thumbnail');
        }

        return null;
    }

    /**
     * Get the users initials.
     *
     * @return string
     */
    public function getInitialsAttribute()
    {
        return $this->first_name[0] . $this->last_name[0];
    }

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumbnail')
            ->width(80)
            ->height(80);
    }
}
