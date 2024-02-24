<?php

namespace App\Http\Controllers\Api;

use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(protected BlogServiceContract $blogService)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = $this->blogService->with([
            'categories',
            'media',
        ])->paginate(config('paginate.default'));

        return BlogResource::collection($blogs);
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
        $blog = $this->blogService->model()->with([
            'categories',
            'media',
        ])->findOrFail($id);

        return new BlogResource($blog);
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
