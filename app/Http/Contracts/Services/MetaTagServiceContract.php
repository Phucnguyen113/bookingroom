<?php
namespace App\Http\Contracts\Services;

use Illuminate\Http\Request;

interface MetaTagServiceContract {
    public function store(Request $request);
}