<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\CustomerFeedbackRepositoryContract;
use App\Http\Contracts\Services\CustomerFeedbackServiceContract;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;

class CustomerFeedbackService implements CustomerFeedbackServiceContract
{
    use ForwardCallToEloquentRepository;

    public function __construct(public CustomerFeedbackRepositoryContract $customerFeedbackRepository)
    {

    }

    public function customerFeedbacks()
    {
        return $this->customerFeedbackRepository->with('room:id,name')->paginate(config('paginate.default'));
    }
}