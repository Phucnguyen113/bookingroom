<?php

namespace App\Models;

use App\Enums\MediaCollection;
use App\Http\Repositories\Filters\Blogs\BlogListFilter;
use App\Http\Repositories\Filters\Filterable;
use App\Http\Repositories\Filters\Filters;
use App\Http\Repositories\Traits\InteractsWithFilterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Tags\HasTags;

class Blog extends Model implements HasMedia, Filterable
{
    use HasFactory, InteractsWithMedia, HasTags, InteractsWithFilterable;

    protected $fillable = [
        'title',
        'description',
        'content',
    ];

    public function registerFilter()
    {
        $this->addFilter(new BlogListFilter);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollection::BlogThumbnail)->singleFile();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_blogs');
    }

    public function thumbnail(): Attribute
    {
        if ($this->relationLoaded('media')) {
            $media = $this->media->where('collection_name', MediaCollection::BlogThumbnail)->first();
        } else {
            $media = $this->getMedia(MediaCollection::BlogThumbnail)->first();
        }
        return Attribute::make(fn () => $media);
    }

    public function relatedBlogs()
    {
        return self::where('id', '!=', $this->id)
            ->where(function (Builder $query) {
                $query->withAnyTagsOfAnyType($this->tags)
                ->orWhereHas('categories', function (Builder $_query) {
                    $_query->whereIn('categories.id', $this->categories->pluck('id')->toArray());
                });
            })->with(['media', 'categories'])
            ->limit(config('paginate.blog.related'))->get();
    }
}
