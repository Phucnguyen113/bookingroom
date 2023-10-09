<?php

namespace App\Http\Controllers;

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
        return view('reservations.index', compact('data'));
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
        //
    }
}
