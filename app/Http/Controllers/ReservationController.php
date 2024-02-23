<?php

namespace App\Http\Controllers;

use App\Enums\Reservation;
use App\Http\Contracts\Repositories\ReservationRepositoryContract;
use App\Http\Contracts\Services\ReservationServiceContract;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct(protected ReservationServiceContract $reservationService, protected ReservationRepositoryContract $reservationRepository)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->reservationService->reservations();
        $locations = $this->reservationService->getLocations();
        return view('reservations.index', compact('data', 'locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->reservationService->delete($id);

        return response()->json();
    }

    public function markSupported(string $id, Request $request)
    {
        $reservation = $this->reservationService->findOrFail($id);

        if ($reservation) {
            $reservation->is_supported = $request->supported == 'true' ? Reservation::Supported : Reservation::NotSupportedYet;
            $reservation->save();
        }

        return response()->json();
    }
}
