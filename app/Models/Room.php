<?php

namespace App\Models;

use App\Enums\MediaCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Room extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $fillable = [
        'name',
        'address',
        'description',
        'price',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollection::RoomThumbnail)->singleFile();
    }
}
