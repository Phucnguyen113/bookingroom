<?php

namespace App\Http\Controllers\Api;

use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Http\Services\CategoryService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomServiceContract $roomService)
    {
        $this->roomService = $roomService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = $this->roomService->paginate(2);
        return RoomResource::collection($room);
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
        $room = $this->roomService->findOrFail($id);
        return new RoomResource($room);
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
