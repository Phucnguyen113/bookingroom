<?php
namespace App\Http\Contracts\Services;

use App\Http\Requests\RoomRequest;

interface RoomServiceContract
{
    public function getServiceRoomTags();
    public function getDependencyDataToCreateOrUpdate();
    public function create(RoomRequest $request);
    public function update(RoomRequest $request, string $id);
    public function delete(string $id);
    public function paginate($limit);
}