<?php

namespace App\Http\Resources;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $en = $request->lang === 'en';
        return [
            'id' => $this->id,
            'title' => $this->when($en, $this->translate?->title, $this->title),
            'description' => $this->when($en, $this->translate?->description, $this->description),
            'content' => $this->when($en, $this->translate?->content, $this->content),
            'categories' => $this->categories->map(fn ($item) => ['id' => $item->id, 'name' => $item->name]),
            'thumbnail' => $this->thumbnail?->getUrl(),
            'created_at' => $this->created_at,
            'related_blogs' => $this->relatedBlogs($en),
        ];
    }

    public function relatedBlogs($en)
    {
        $relatedBlogs = $this->resource->relatedBlogs();
        return $relatedBlogs->map(function (Blog $blog) use ($en) {
            return [
                'id' => $blog->id,
                'title' => $this->when($en, $blog->translate?->title, $blog->title),
                'description' => $this->when($en, $blog->translate?->description, $blog->description),
                'content' => $this->when($en, $blog->translate?->content, $blog->content),
                'categories' => $blog->categories->map(fn ($item) => ['id' => $item->id, 'name' => $item->name]),
                'thumbnail' => $blog->thumbnail?->getUrl(),
                'en' => $this->when($blog->translate, [
                    'title' => $blog->translate?->title,
                    'description' => $blog->translate?->description,
                    'content' => $blog->translate?->content,
                ]),
                'created_at' => $blog->created_at,
            ];
        });
    }
}
