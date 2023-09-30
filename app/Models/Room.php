<?php

namespace App\Models;

use App\Enums\MediaCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Room extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTags;

    public $fillable = [
        'name',
        'address',
        'description',
        'price',
        'unit',
        'province',
        'district',
        'start_date',
        'end_date',
        'bedroom',
        'bathroom',
        'acreage',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollection::RoomThumbnail)->singleFile();

        $this->addMediaCollection(MediaCollection::RoomImages)->onlyKeepLatest(5);
    }

    public function thumbnail(): Attribute
    {
        if ($this->relationLoaded('media')) {
            $thumbnail =  $this->media->where('collection_name', MediaCollection::RoomThumbnail)->first();
        } else {
            $thumbnail = $this->getMedia(MediaCollection::RoomThumbnail)->first();
        }

        return Attribute::make(
            fn () => $thumbnail,
            function (UploadedFile $file) {
                return $this->addMedia($file)->toMediaCollection(MediaCollection::RoomThumbnail);
            }
        );
    }

    public function images(): Attribute
    {
        if ($this->relationLoaded('media')) {
            $images = $this->media->where('collection_name', MediaCollection::RoomImages);
        } else {
            $images = $this->getMedia(MediaCollection::RoomImages);
        }

        return Attribute::make(
            fn () => $images,
            // function (UploadedFile $file) {
            //     return $this->addMedia($file)->toMediaCollection(MediaCollection::RoomThumbnail);
            // }
        );
    }
}
