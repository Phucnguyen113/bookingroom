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

    public function roomsWithHighestView()
    {
        return $this->model->orderByDesc('view_count')
        ->limit(10)->get(['id', 'name', 'view_count']);
    }
}