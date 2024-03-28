<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerMessageRequest;
use App\Models\CustomerMessage;
use Illuminate\Http\Request;

class CustomerMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CustomerMessage::paginate(config('paginate.default'));
        return view('customerMessage.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customerMessage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerMessageRequest $request)
    {
        $customerMessage = CustomerMessage::create($request->only(['name', 'message']));

        $customerMessage->addMedia($request->file('image'))->toMediaCollection(CustomerMessage::CollectionName);

        return redirect()->route('customer-messages.index');
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
        $customerMessage = CustomerMessage::findOrFail($id);

        return view('customerMessage.edit', ['data' => $customerMessage]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerMessageRequest $request, string $id)
    {
        $customerMessage = CustomerMessage::findOrFail($id);

        $customerMessage->update($request->only(['name', 'message']));

        if ($request->hasFile('image')) {
            $customerMessage->addMedia($request->file('image'))->toMediaCollection(CustomerMessage::CollectionName);
        }

        return redirect()->route('customer-messages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customerMessage = CustomerMessage::findOrFail($id);
        $customerMessage->delete();

        return response()->json();
    }
}
