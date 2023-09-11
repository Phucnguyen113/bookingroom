<?php
namespace App\Http\Contracts\Services;

use App\Http\Requests\MetaTagRequest;
use Illuminate\Http\Request;

interface MetaTagServiceContract {
    public function store(Request $request);
    public function getListMetaTag();
    public function update(MetaTagRequest $request, string $id);
}