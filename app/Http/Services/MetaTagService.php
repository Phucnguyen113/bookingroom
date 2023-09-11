<?php

namespace App\Http\Services;

use App\Http\Contracts\Repositories\MetaTagRepositoryContract;
use App\Http\Contracts\Services\MetaTagServiceContract;
use App\Http\Requests\MetaTagRequest;
use Illuminate\Http\Request;

class MetaTagService implements MetaTagServiceContract {

    protected $metaTagRepository;

    public function __construct(MetaTagRepositoryContract $metaTagRepository)
    {
        $this->metaTagRepository = $metaTagRepository;
    }

    public function store(Request $request)
    {
        return $this->metaTagRepository->create($request->only('name', 'content'));
    }

    public function getListMetaTag()
    {
        return $this->metaTagRepository->all();
    }

    public function getMetaTagById(string $id)
    {
        return $this->metaTagRepository->findOrFail($id);
    }

    public function update(MetaTagRequest $request, string $id)
    {
        return $this->metaTagRepository->where('id', $id)
        ->update($request->only(['name', 'content']));
    }

    public function delete(string $id)
    {
        return $this->metaTagRepository->where('id', $id)->delete();
    }
}