<?php

namespace App\Http\Controllers;

use App\Enums\Tags;
use App\Http\Contracts\Services\BlogServiceContract;
use App\Http\Requests\BlogRequest;
use App\Http\Services\CategoryService;

class BlogController extends Controller
{
    protected $blogService;
    protected $categoryService;
    public function __construct(BlogServiceContract $blogService, CategoryService $categoryService)
    {
        $this->blogService = $blogService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->blogService->getListBlogs();
        return view('blogs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->blogService->getDependencyDataToCreateOrUpdate();
        return view('blogs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $this->blogService->store($request);
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = $this->blogService->find($id);
        return view('blogs.detail', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = $this->blogService->find($id);
        $data = $this->blogService->getDependencyDataToCreateOrUpdate();
        $data['blog'] = $blog;

        return view('blogs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        $this->blogService->update($request, $id);
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->blogService->delete($id);
        return response()->json();
    }
}
