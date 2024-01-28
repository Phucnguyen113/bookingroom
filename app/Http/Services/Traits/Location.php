<?php
namespace App\Http\Services\Traits;

use App\Models\Province;
use Illuminate\Support\Facades\Http;

trait Location {
    public function getLocations()
    {
        try {
            return Province::with('districts')->get();
        } catch (\Throwable $th) {
            return abort(404);
        } 
    }


}