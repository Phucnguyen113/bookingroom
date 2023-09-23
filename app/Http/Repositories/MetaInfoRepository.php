<?php
namespace App\Http\Repositories;

use App\Models\MetaInfo;

class MetaInfoRepository extends EloquentRepository
{
    public function __construct(MetaInfo $model)
    {
        parent::__construct($model);
    }
}