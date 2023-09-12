<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Models\Blog;

class BlogRepository extends EloquentRepository implements BlogRepositoryContract 
{
    protected $model;

    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }


}