<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerMessageResource;
use App\Models\CustomerMessage;
use Illuminate\Http\Request;

class CustomerMessageController extends Controller
{
    public function index()
    {
        $data = CustomerMessage::with('media')->paginate(config('paginate.default'));

        return CustomerMessageResource::collection($data);
    }
}
