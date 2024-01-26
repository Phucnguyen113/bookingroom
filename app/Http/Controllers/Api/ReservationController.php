<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\CustomerBooking;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $reservation = Reservation::create($request->only([
            'name',
            'phone',
            'email',
            'room_id',
            'room_type',
            'min_price',
            'max_price',
            'location',
            'bedroom',
            'bathroom',
        ]));

        $this->notifyCustomerBookingToAllUsers($reservation);
        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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

    public function notifyCustomerBookingToAllUsers(Reservation $reservation)
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            $user->notify(new CustomerBooking($reservation));
        }
    }
}
