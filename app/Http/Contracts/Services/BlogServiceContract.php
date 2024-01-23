<?php
namespace App\Http\Contracts\Services;

use App\Http\Requests\BlogRequest;
use Illuminate\Database\Eloquent\Collection;

interface BlogServiceContract {
    public function store(BlogRequest $request);
    public function update(BlogRequest $request, string $id);
    public function getListBlogs();
    public function getDependencyDataToCreateOrUpdate();
    public function getBlogsHomePage(): Collection;
}