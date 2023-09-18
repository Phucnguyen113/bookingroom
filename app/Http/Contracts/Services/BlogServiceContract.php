<?php
namespace App\Http\Contracts\Services;

use App\Http\Requests\BlogRequest;

interface BlogServiceContract {
    public function store(BlogRequest $request);
    public function update(BlogRequest $request, string $id);
    public function getListBlogs();
}