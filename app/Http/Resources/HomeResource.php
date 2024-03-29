<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'rooms' => RoomResource::collection($this['rooms']),
            'blogs' => BlogResource::collection($this['blogs']),
            'meta_info' => MetaInfoResource::collection($this['metaInfo']),
        ];
    }
}
