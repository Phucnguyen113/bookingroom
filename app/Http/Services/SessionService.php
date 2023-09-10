<?php

namespace App\Http\Services;

use App\Http\Contracts\Services\SessionContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionService implements SessionContract{

    public function login(Request $request)
    {
        return Auth::attempt($request->only(['email', 'password']));
    }

    public function logout()
    {
        Auth::logout();
    }
}