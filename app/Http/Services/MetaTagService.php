<?php

namespace App\Http\Services;

use App\Http\Contracts\Repositories\MetaTagRepositoryContract;
use App\Http\Contracts\Services\MetaTagServiceContract;
use Illuminate\Http\Request;

class MetaTagService implements MetaTagServiceContract {

    protected $metaTagRepository;

    public function __construct(MetaTagRepositoryContract $metaTagRepository)
    {
        $this->metaTagRepository = $metaTagRepository;
    }

    public function store(Request $request)
    {
        return $this->metaTagRepository->create(['name' => $request->name]);
    }

    public function getListMetaTag()
    {
        return $this->metaTagRepository->all();
    }
}