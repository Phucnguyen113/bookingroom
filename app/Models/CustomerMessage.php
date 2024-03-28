<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CustomerMessage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const CollectionName = 'customer-message';

    protected $fillable = [
        'name',
        'message',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::CollectionName)->singleFile();
    }
}
