<?php

namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\RoomRepositoryContract;
use App\Models\Room;
use Closure;
use Illuminate\Database\Eloquent\Collection;

class RoomRepository extends EloquentRepository implements RoomRepositoryContract {
    protected $model;

    public function __construct(Room $model)
    {
        parent::__construct($model);
    }

    /**
     * @param null|int $limit
     *
     * @return Collection
     */
    public function roomsWithHighestView(null|int $limit = null, null|Closure $builder = null) : Collection
    {
        $query = $this->model->orderByDesc('view_count');

        if ($builder instanceof Closure) {
            $builder($query);
        }

        return $query->limit($limit ?? config('paginate.default'))
            ->get();
    }
}
