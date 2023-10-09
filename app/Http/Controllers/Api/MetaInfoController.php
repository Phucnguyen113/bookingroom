<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetaInfoResource;
use App\Http\Services\MetaInfoService;
use Illuminate\Http\Request;

class MetaInfoController extends Controller
{
    public function __construct(protected MetaInfoService $metaInfoService)
    {

    }

    public function index()
    {
        $data = $this->metaInfoService->with('media')->get();

        return MetaInfoResource::collection($data);
    }
}
