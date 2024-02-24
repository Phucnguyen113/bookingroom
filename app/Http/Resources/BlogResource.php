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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'categories' => $this->categories->map(fn ($item) => ['id' => $item->id, 'name' => $item->name]),
            'thumbnail' => $this->thumbnail->getUrl(),
            'created_at' => $this->created_at,
            'related_blogs' => $this->relatedBlogs(),
            'en' => [
                'title' => $this->translate?->title,
                'description' => $this->translate?->description,
                'content' => $this->translate?->content,
            ],
        ];
    }

    public function relatedBlogs()
    {
        $relatedBlogs = $this->resource->relatedBlogs();
        return $relatedBlogs->map(function (Blog $blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'description' => $blog->description,
                'content' => $blog->content,
                'categories' => $blog->categories->map(fn ($item) => ['id' => $item->id, 'name' => $item->name]),
                'thumbnail' => $blog->thumbnail?->getUrl(),
                'en' => [
                    'title' => $blog->translate?->title,
                    'description' => $blog->translate?->description,
                    'content' => $blog->translate?->content,
                ],
                'created_at' => $blog->created_at,
            ];
        });
    }
}
