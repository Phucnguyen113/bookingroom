<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Traits\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    use Location;

    public function index()
    {
        return response()->json($this->getLocations());
    }

    public function search(string|int $code)
    {
        return response()->json($this->getLocation($code));
    }
}
