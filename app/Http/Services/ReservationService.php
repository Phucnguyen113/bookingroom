<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\ReservationRepositoryContract;
use App\Http\Contracts\Services\ReservationServiceContract;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;
use App\Http\Services\Traits\Location;

class ReservationService implements ReservationServiceContract
{
    use Location, ForwardCallToEloquentRepository;

    public function __construct(protected ReservationRepositoryContract $reservationRepository)
    {

    }

    public function reservations()
    {
        return $this->reservationRepository->with(['room'])->latest()->paginate(config('paginate.default'));
    }

    public function delete(string $id)
    {
        return $this->reservationRepository->where('id', $id)->delete();
    }
}
