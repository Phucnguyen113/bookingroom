<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\CustomerFeedbackRepositoryContract;
use App\Models\CustomerFeedback;

class CustomerFeedbackRepository extends EloquentRepository implements CustomerFeedbackRepositoryContract
{
    public function __construct(CustomerFeedback $model)
    {
        parent::__construct($model);
    }
}