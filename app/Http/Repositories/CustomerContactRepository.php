<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\CustomerContactRepositoryContract;
use App\Models\CustomerContact;

class CustomerContactRepository extends EloquentRepository implements CustomerContactRepositoryContract
{
    public function __construct(CustomerContact $model)
    {
        parent::__construct($model);
    }
}