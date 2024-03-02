<?php
namespace App\Http\Services;

use App\Enums\MediaCollection;
use App\Enums\Tags;
use App\Enums\TypeCategory;
use App\Http\Contracts\Repositories\CategoryRepositoryContract;
use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Requests\RoomRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;
use App\Http\Services\Traits\Location;
use App\Http\Support\OptimizeImage;
use App\Models\Room;
use Closure;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;
use Spatie\Tags\Tag;
use Illuminate\Support\Str;
class RoomService implements RoomServiceContract
{
    use ForwardCallToEloquentRepository, Location;

    protected $roomRepository;
    protected $categoryRepository;

    public function __construct(RoomRepositoryContract $roomRepository, CategoryRepositoryContract $categoryRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->categoryRepository = $categoryRepository;
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
            'room_type',
        ]));
        $room->translate()->create([
            'name' => $request->en_name,
            'description' => $request->en_description,
            'address' => $request->en_address,
        ]);
        $room->addMedia($request->file('thumbnail'))->toMediaCollection(MediaCollection::RoomThumbnail);
        foreach ($request->images as $key => $image) {
            $room->addMedia($image)->toMediaCollection(MediaCollection::RoomImages);
        }

        $room->attachTags($request->general_amenities, Tags::RoomService['general_amenities']);
        $room->attachTags($request->outdoor_facilities, Tags::RoomService['outdoor_facilities']);

        $room->categories()->attach($request->category);
        $media = $room->media()->where('optimized', false)
        ->whereIn('mime_type', ['image/jpeg', 'image/gif'])->get();
        foreach ($media as $key => $image) {
            OptimizeImage::load($image)->optimize()->save();
        };
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
            'room_type'
        ]));

        $this->updateOrCreateTranslate($room, $request);

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

        $room->categories()->sync($request->category);

        $media = $room->media()->where('optimized', false)
        ->whereIn('mime_type', ['image/jpeg', 'image/gif'])->get();
        foreach ($media as $key => $image) {
            OptimizeImage::load($image)->optimize()->save();
        };
    }

    public function getServiceRoomTags()
    {
        return Tag::whereIn('type', Tags::RoomService)
        ->get()->map(function ($item) {
            $item->name = Str::title($item->name);
            return $item;
        })->groupBy('type');
    }

    public function getDependencyDataToCreateOrUpdate()
    {
        $serviceTags = $this->getServiceRoomTags();
        $categories = $this->categoryRepository->getCategoriesByType(TypeCategory::Room, ['id', 'name']);
        $locations = $this->getLocations();
        return compact('serviceTags', 'categories', 'locations');
    }

    public function delete(string $id)
    {
        $room = $this->roomRepository->find($id);

        if ($room) {
            $room->categories()->detach();
            $room->delete();
        }
    }

    public function paginate($limit)
    {
        return $this->roomRepository
        ->with([
            'media',
            'tags',
        ])->paginate($limit);
    }

    public function getRoomHighestView(null|int $limit = null, null|Closure $builder = null)
    {
        return $this->roomRepository->roomsWithHighestView($limit, $builder);
    }

    public function findOrFail(string|int $id): Room
    {
        $room =  $this->roomRepository->findOrFail($id);

        $room->load([
            'media',
        ]);

        return $room;
    }

    public function updateOrCreateTranslate(Room $room, RoomRequest $request)
    {
        $translate = $room->translate;
        if ($translate) {
            $translate->update([
                'name' => $request->en_name,
                'description' => $request->en_description,
                'address' => $request->en_address,
            ]);
        } else {
            $room->translate()->create([
                'name' => $request->en_name,
                'description' => $request->en_description,
                'address' => $request->en_address,
            ]);
        }
    }
}
