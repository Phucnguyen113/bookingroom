<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\ReservationRepositoryContract;
use App\Http\Contracts\Services\ReservationServiceContract;

class ReservationService implements ReservationServiceContract
{
    public function __construct(protected ReservationRepositoryContract $reservationRepository)
    {

    }

    public function reservations()
    {
        return $this->reservationRepository->with(['room'])->paginate(config('paginate.default'));
    }
}