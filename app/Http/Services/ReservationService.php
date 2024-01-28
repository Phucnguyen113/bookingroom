<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\ReservationRepositoryContract;
use App\Http\Contracts\Services\ReservationServiceContract;
use App\Http\Services\Traits\Location;

class ReservationService implements ReservationServiceContract
{
    use Location;

    public function __construct(protected ReservationRepositoryContract $reservationRepository)
    {

    }

    public function reservations()
    {
        return $this->reservationRepository->with(['room'])->paginate(config('paginate.default'));
    }
}