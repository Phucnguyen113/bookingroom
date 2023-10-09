<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\ReservationRepositoryContract;
use App\Models\Reservation;

class ReservationRepository extends EloquentRepository implements ReservationRepositoryContract
{
    public function __construct(Reservation $model)
    {
        parent::__construct($model);
    }
}