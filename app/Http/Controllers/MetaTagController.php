<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\MetaTagServiceContract;
use App\Http\Requests\MetaTagRequest;
use Illuminate\Http\Request;

class MetaTagController extends Controller
{
    protected $metaTagService;

    public function __construct(MetaTagServiceContract $metaTagService)
    {
        $this->metaTagService = $metaTagService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $data = $this->metaTagService->getListMetaTag();
        return view('tags.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MetaTagRequest $request)
    {
        $this->metaTagService->store($request);
        return redirect('/tags');
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
        //
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
