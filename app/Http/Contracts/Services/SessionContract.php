<?php
namespace App\Http\Contracts\Services;

use Illuminate\Http\Request;

interface SessionContract {
    public function login(Request $request);

    public function logout();
}