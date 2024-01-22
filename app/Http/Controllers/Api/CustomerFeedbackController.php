<?php

namespace App\Http\Controllers\Api;

use App\Http\Contracts\Repositories\UserRepositoryContract;
use App\Http\Contracts\Services\CustomerFeedbackServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerFeedbackRequest;
use App\Models\CustomerFeedback as ModelsCustomerFeedback;
use App\Notifications\CustomerFeedback;

class CustomerFeedbackController extends Controller
{
    public function __construct(
        protected CustomerFeedbackServiceContract $customerFeedbackService,
        protected UserRepositoryContract $userRepository
    ){}


    public function store(CustomerFeedbackRequest $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'room_id', 'message', 'rating']);
        if (!isset($data['rating'])) {
            $data['rating'] = 5;
        }
        $customerFeedback = $this->customerFeedbackService->create($data);
        $this->nottifyCustomerFeedbackToAllUsers($customerFeedback);
        return response()->json();
    }

    public function nottifyCustomerFeedbackToAllUsers(ModelsCustomerFeedback $customerFeedback)
    {
        $users = $this->userRepository->all();

        foreach ($users as $key => $user) {
            $user->notify(new CustomerFeedback($customerFeedback));
        }
    }

}
