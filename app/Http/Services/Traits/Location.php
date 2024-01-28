<?php
namespace App\Http\Services\Traits;

use App\Models\Province;
trait Location {
    public function getLocations()
    {
        try {
            return Province::with('districts')->get();
        } catch (\Throwable $th) {
            return abort(404);
        } 
    }

    public function getLocation(string|int $code): Province|null
    {
        return Province::where('code', $code)->with('districts')->first();
    }
}
