<?php
namespace App\Http\Support;

use Spatie\Image\Image;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OptimizeImage
{
    protected ?Image $image;

    public function __construct(protected Media $media)
    {
        $this->image = Image::load($media->getPath()); 
    }

    public function save(string $outputPath = ''): void
    {
        if ($this->media->optimized) {
            return;
        }

        $this->image->save($outputPath);
        Media::where('id', $this->media->id)->update([
            'optimized' => true,
        ]);
    }
    
    public static function load(Media $media)
    {
        return new static($media);
    }

    public function __call($name, $arguments): static
    {
        $this->image->{$name}(...$arguments);

        return $this;
    }
}