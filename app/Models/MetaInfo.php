<?php

namespace App\Models;

use App\Enums\MediaCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MetaInfo extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'meta_info';

    protected $fillable = [
        'type',
        'value'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollection::MetaLogo)->singleFile();

        $this->addMediaCollection(MediaCollection::MetaSlides)->onlyKeepLatest(5);
    }
}
