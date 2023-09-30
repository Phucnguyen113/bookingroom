<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\CategoryServiceContract;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceContract $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->categoryService->all();
        return view('categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = \App\Enums\TypeCategory::asSelectArray();
        return view('categories.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryService->create($request->only('name', 'type'));

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->findOrFail($id);
        $types = \App\Enums\TypeCategory::asSelectArray();
        return view('categories.edit', compact('category', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $this->categoryService->update($request, $id);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoryService->delete($id);

        return redirect()->route('category.index');
    }
}
