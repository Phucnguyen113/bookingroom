<?php

namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Models\Room;

class RoomRepository extends EloquentRepository implements RoomRepositoryContract {
    protected $model;

    public function __construct(Room $model)
    {
        parent::__construct($model);
    }
}