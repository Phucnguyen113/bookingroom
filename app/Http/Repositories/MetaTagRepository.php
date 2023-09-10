<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\MetaTagRepositoryContract;
use App\Models\MetaTag;
use App\Http\Repositories\EloquentRepository;

class MetaTagRepository extends EloquentRepository implements MetaTagRepositoryContract
{
    public function __construct(MetaTag $model)
    {
        $this->model = $model;
    }

}