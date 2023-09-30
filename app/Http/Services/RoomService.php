<?php
namespace App\Http\Services;

use App\Enums\MediaCollection;
use App\Enums\Tags;
use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Requests\RoomRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;
use Spatie\Tags\Tag;

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
        $room = $this->roomRepository->create($request->only([
            'name',
            'description',
            'address',
            'price',
            'unit',
            'province',
            'district',
            'start_date',
            'end_date',
            'bedroom',
            'bathroom',
            'acreage',
        ]));

        $room->addMedia($request->file('thumbnail'))->toMediaCollection(MediaCollection::RoomThumbnail);
        foreach ($request->images as $key => $image) {
            $room->addMedia($image)->toMediaCollection(MediaCollection::RoomImages);
        }

        $room->attachTags($request->general_amenities, Tags::RoomService['general_amenities']);
        $room->attachTags($request->outdoor_facilities, Tags::RoomService['outdoor_facilities']);
    }

    public function update(RoomRequest $request, string $id)
    {
        $room = $this->roomRepository->findOrFail($id);
        $room->update($request->only([
            'name',
            'description',
            'address',
            'price',
            'unit',
            'province',
            'district',
            'start_date',
            'end_date',
            'bedroom',
            'bathroom',
            'acreage',
        ]));

        if ($request->hasFile('thumbnail')) {
            $room->addMedia($request->file('thumbnail'))->toMediaCollection(MediaCollection::RoomThumbnail);
        }

        if ($request->images) {
            foreach ($request->images as $key => $image) {
               $room->addMedia($image)->toMediaCollection(MediaCollection::RoomImages);
            }
        }

        $room->syncTagsWithType($request->general_amenities, Tags::RoomService['general_amenities']);
        $room->syncTagsWithType($request->outdoor_facilities, Tags::RoomService['outdoor_facilities']);
    }

    public function getServiceRoomTags()
    {
        return Tag::whereIn('type', Tags::RoomService)
        ->get()->groupBy('type');
    }
}