<?php
namespace App\Http\Services\Traits;

use Illuminate\Support\Facades\Http;

trait Location {
    public function getLocations()
    {
        try {
            return Http::get('https://provinces.open-api.vn/api/?depth=2')->json();
        } catch (\Throwable $th) {
            return abort(404);
        } 
    }


}