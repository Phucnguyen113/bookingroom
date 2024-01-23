<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository extends EloquentRepository implements BlogRepositoryContract 
{
    protected $model;

    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function getBlogsHomePage(): Collection
    {
        return $this->model->latest()->limit(config('paginate.home.blog'))->get();
    }
}