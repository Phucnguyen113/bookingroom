<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetaInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->type => $this->value,
            'images' => $this->when($this->type === 'slides', $this->media->map(fn ($media) => $media->getUrl())),
        ];
    }
}
