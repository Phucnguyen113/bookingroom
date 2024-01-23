<?php
namespace App\Http\Contracts\Services;

use App\Http\Requests\RoomRequest;
use Closure;
use Illuminate\Database\Eloquent\Collection;

interface RoomServiceContract
{
    public function getServiceRoomTags();
    public function getDependencyDataToCreateOrUpdate();
    public function create(RoomRequest $request);
    public function update(RoomRequest $request, string $id);
    public function delete(string $id);
    public function paginate($limit);

    /**
     * @return Collection
     */
    public function getRoomHighestView(null|int $limit = null, null|Closure $builder = null); 
}
