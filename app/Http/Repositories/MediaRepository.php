<?php
namespace App\Http\Repositories;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaRepository extends EloquentRepository
{
    public function __construct(Media $model)
    {
        parent::__construct($model);
    }
}