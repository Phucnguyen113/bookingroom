<?php
namespace App\Http\Repositories;

use App\Http\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}