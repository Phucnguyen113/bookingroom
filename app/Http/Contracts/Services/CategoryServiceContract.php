<?php
namespace App\Http\Contracts\Services;

use App\Http\Requests\CategoryRequest;

interface CategoryServiceContract
{
    public function delete(string $id);
    public function update(CategoryRequest $request, string $id);
}