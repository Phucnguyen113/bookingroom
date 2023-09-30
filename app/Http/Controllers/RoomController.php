<?php

namespace App\Http\Controllers;

use App\Enums\Tags;
use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Requests\RoomRequest;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

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
        $rooms = $this->roomService->all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $serviceTags = $this->roomService->getServiceRoomTags();

        return view('rooms.create', compact('serviceTags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $this->roomService->create($request);

        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = $this->roomService->findOrFail($id);
        $room->loadMedia('*');

        return view('rooms.detail', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = $this->roomService->find($id);
        $serviceTags = $this->roomService->getServiceRoomTags();
        return view('rooms.edit', compact('room', 'serviceTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, string $id)
    {
        $this->roomService->update($request, $id);

        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
