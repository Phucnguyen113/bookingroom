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
        $rooms = $this->roomService->paginate(15);
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->roomService->getDependencyDataToCreateOrUpdate();

        return view('rooms.create', $data);
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
        $data = $this->roomService->getDependencyDataToCreateOrUpdate();
        $data['room'] = $room;
        return view('rooms.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = $this->roomService->find($id);
        $data = $this->roomService->getDependencyDataToCreateOrUpdate();
        $data['room'] = $room;
        return view('rooms.edit', $data);
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
        $this->roomService->delete($id);
        return response()->json();
    }
}
