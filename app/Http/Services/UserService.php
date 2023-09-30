<?php
namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;

class UserService
{
    use ForwardCallToEloquentRepository;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

}