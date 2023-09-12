<?php

namespace App\Http\Services;

use App\Http\Contracts\Repositories\BlogRepositoryContract;
use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class BlogService implements BlogServiceContract {

    protected $blogRepository;

    public function __construct(BlogRepositoryContract $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function store(BlogRequest $request)
    {
        $this->blogRepository->create($request->only(['title', 'content']));
        return redirect()->route('blogs.index');
    }

    public function update(Request $request, string $id)
    {

    }
}
