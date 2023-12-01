<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property string $name
 * @property int $user_id
 * @property int $category_id
 */
class Notes extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    public $appends = ['image'];
    public const IMAGE_COLLECTION_NAME = 'images';

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::IMAGE_COLLECTION_NAME);
    }

    /**
     * @param Media|null $media
     * @return void
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    /**
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Notes::class);
    }
}
