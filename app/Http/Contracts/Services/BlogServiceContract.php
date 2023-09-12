<?php
namespace App\Http\Contracts\Services;

use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

interface BlogServiceContract {
    public function store(BlogRequest $request);
    public function update(Request $request, string $id);
}