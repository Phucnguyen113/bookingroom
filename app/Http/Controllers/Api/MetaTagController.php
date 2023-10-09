<?php

namespace App\Http\Controllers\Api;

use App\Http\Contracts\Services\MetaTagServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\MetaTagResource;
use Illuminate\Http\Request;

class MetaTagController extends Controller
{
    public function __construct(protected MetaTagServiceContract $metaTagService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->metaTagService->getListMetaTag();

        return MetaTagResource::collection($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = $this->metaTagService->findOrFail($id);
        return new MetaTagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
