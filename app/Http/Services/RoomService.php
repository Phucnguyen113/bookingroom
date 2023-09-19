<?php
namespace App\Http\Services;

use App\Enums\MediaCollection;
use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Requests\RoomRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;


class RoomService implements RoomServiceContract
{
    use ForwardCallToEloquentRepository;

    protected $roomRepository;

    public function __construct(RoomRepositoryContract $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }


    public function create(RoomRequest $request)
    {
        $room = $this->roomRepository->create($request->only(['name', 'description', 'address', 'price']));

        $room->addMedia($request->file('thumbnail'))->toMediaCollection(MediaCollection::RoomThumbnail);
        foreach ($request->images as $key => $image) {
            $room->addMedia($image)->toMediaCollection(MediaCollection::RoomImages);
         }
    }

    public function update(RoomRequest $request, string $id)
    {
        $room = $this->roomRepository->findOrFail($id);
        $room->update($request->only('name', 'price', 'address', 'description'));

        if ($request->hasFile('thumbnail')) {
            $room->addMedia($request->file('thumbnail'))->toMediaCollection(MediaCollection::RoomThumbnail);
        }

        if ($request->images) {
            foreach ($request->images as $key => $image) {
               $room->addMedia($image)->toMediaCollection(MediaCollection::RoomImages);
            }
        }
    }

}