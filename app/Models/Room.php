<?php

namespace App\Models;

use App\Enums\MediaCollection;
use App\Enums\Tags;
use App\Http\Repositories\Filters\Filterable;
use App\Http\Repositories\Filters\Rooms\RoomListFilter;
use App\Http\Repositories\Traits\InteractsWithFilterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Room extends Model implements HasMedia, Filterable
{
    use HasFactory, InteractsWithMedia, HasTags, InteractsWithFilterable;

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
        'view_count',
        'room_type',
    ];

    protected $with = ['translate'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollection::RoomThumbnail)->singleFile();

        $this->addMediaCollection(MediaCollection::RoomImages)->onlyKeepLatest(config('media.room.limit-images'));
    }

    public function registerFilter()
    {
        $this->addFilter(new RoomListFilter());
    }

    public function thumbnail(): Attribute
    {
        if ($this->relationLoaded('media')) {
            $thumbnail =  $this->media->where('collection_name', MediaCollection::RoomThumbnail)->first();
        }

        return Attribute::make(
            fn () => $thumbnail ?? null,
            // function (UploadedFile $file) {
            //     return $this->addMedia($file)->toMediaCollection(MediaCollection::RoomThumbnail);
            // }
        );
    }

    public function images(): Attribute
    {
        if ($this->relationLoaded('media')) {
            $images = $this->media->where('collection_name', MediaCollection::RoomImages);
        }

        return Attribute::make(
            fn () => $images ?? collect([]),
            // function (UploadedFile $file) {
            //     return $this->addMedia($file)->toMediaCollection(MediaCollection::RoomThumbnail);
            // }
        );
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_rooms');
    }

    public function customerFeedbacks()
    {
        return $this->hasMany(CustomerFeedback::class, 'room_id', 'id');
    }

    public function translate()
    {
        return $this->hasOne(RoomTranslate::class);
    }

    public function relatedRooms()
    {
        $relatedRooms = self::where('id', '!=', $this->id)
        ->where(function (Builder $query) {
            $query->orWhere([
                'bedroom' => $this->bedroom,
                'bathroom' => $this->bathroom,
                'acreage' => $this->acreage,
                'province' => $this->province,
                'district' => $this->district,
            ]);
        })
        ->with('media')->limit(config('paginate.room.related'))->get();

        $this->relatedRooms = $relatedRooms;

        return $relatedRooms;

    }
}
