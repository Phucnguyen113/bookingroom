<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Http\Contracts\Services\RoomServiceContract;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;


class RoomService implements RoomServiceContract
{
    use ForwardCallToEloquentRepository;

    protected $roomRepository;

    public function __construct(RoomRepositoryContract $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

}