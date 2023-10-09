<?php

namespace App\Http\Controllers\Api;

use App\Http\Contracts\Services\CustomerContactServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerContactRequest;
use Illuminate\Http\Request;

class CustomerContactController extends Controller
{
    public function __construct(protected CustomerContactServiceContract $customerContactService)
    {

    }
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
    public function store(CustomerContactRequest $request)
    {
        $this->customerContactService->create($request->only(['name', 'email', 'phone', 'subject', 'message']));

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
}
