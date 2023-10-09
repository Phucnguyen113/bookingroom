<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\CustomerFeedbackRepositoryContract;
use App\Http\Contracts\Services\CustomerFeedbackServiceContract;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;

class CustomerFeebackService implements CustomerFeedbackServiceContract
{
    use ForwardCallToEloquentRepository;

    public function __construct(protected CustomerFeedbackRepositoryContract $customerFeedbackRepository)
    {

    }
}