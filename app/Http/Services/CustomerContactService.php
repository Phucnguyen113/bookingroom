<?php
namespace App\Http\Services;

use App\Http\Contracts\Repositories\CustomerContactRepositoryContract;
use App\Http\Contracts\Services\CustomerContactServiceContract;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;


class CustomerContactService implements CustomerContactServiceContract
{
    use ForwardCallToEloquentRepository;

    public function __construct(protected CustomerContactRepositoryContract $customerContactRepository)
    {

    }

    public function customerContacts()
    {
        return $this->customerContactRepository->latest()->paginate(config('paginate.default'));
    }
}