<?php

namespace App\Http\Resources;

use App\Enums\Tags;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'price' => $this->price,
            'unit' => $this->unit,
            'province' => $this->province,
            'district' => $this->district,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'bedroom' => $this->bedroom,
            'bathroom' => $this->bathroom,
            'acreage' => $this->acreage,
            'images' => $this->whenLoaded('media', $this->images->map(fn ($image) => $image->getUrl())->values(), []),
            'thumbnail' => $this->whenLoaded('media', $this->thumbnail?->getUrl(), null),
            'categories' => $this->whenLoaded('categories', $this->categories->map(fn ($item) => ['id' => $item->id, 'name' => $item->name]), []),
            'tags' => $this->whenLoaded('tags', $this->loadTags(), []),
        ];
    }

    public function loadTags()
    {
        $result = [];
        $tags = $this->tags->mapToGroups(fn ($item) => [$item->type => $item->name]);
        $tagKeys = Tags::fromValue(Tags::RoomService);
        foreach ($tagKeys->value as $key => $value) {
           $result[$key] = $tags[$value];
        }

        return $result;
    }
}
