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
     * The attributes that are mass assignable.
     *
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'initials',
        'avatar',
        'full_name'
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
     * The user that the profile belongs to.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' .$this->last_name;
    }

    /**
     * Get the users avatar url
     *
     * @return string|null
     */
    public function getAvatarAttribute()
    {
        if ($this->hasMedia('avatar')) {
            return $this->getFirstMediaUrl('avatar', 'thumbnail');
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
        if ($this->first_name && $this->last_name) {
            return $this->first_name[0] . $this->last_name[0];
        }
        return '';
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

    /**
     * Register media collections for a profile.
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')->singleFile();
    }
}
