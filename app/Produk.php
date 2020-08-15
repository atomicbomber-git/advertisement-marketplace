<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Image;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int penjual_id
 */
class Produk extends Model implements HasMedia
{
    use InteractsWithMedia;

    const COLLECTION_DEFAULT = 'default';
    const CONVERSION_THUMB = 'thumb';
    const THUMB_MAX_WIDTH_PIXELS = 640;
    public $registerMediaConversionsUsingModelInstance = true;

    protected $table = "produk";
    protected $guarded = [];

    public function penjual(): BelongsTo
    {
        return $this->belongsTo(Penjual::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $originalImage = Image::load($this->getFirstMediaPath());

        $this
            ->addMediaConversion(self::CONVERSION_THUMB)
            ->width(self::THUMB_MAX_WIDTH_PIXELS)
            ->height(self::THUMB_MAX_WIDTH_PIXELS / $originalImage->getWidth() * $originalImage->getHeight());
    }
}
