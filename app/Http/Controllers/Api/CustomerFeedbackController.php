<?php

namespace App\Http\Controllers\Api;

use App\Http\Contracts\Services\CustomerFeedbackServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerFeedbackRequest;
use Illuminate\Http\Request;

class CustomerFeedbackController extends Controller
{
    public function __construct(protected CustomerFeedbackServiceContract $customerFeedbackService)
    {

    }

    public function store(CustomerFeedbackRequest $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'room_id', 'message', 'rating']);
        if (!isset($data['rating'])) {
            $data['rating'] = 5;
        }
        $this->customerFeedbackService->create($data);

        return response()->json();
    }

}
