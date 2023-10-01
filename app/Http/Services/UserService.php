<?php
namespace App\Http\Services;

use App\Enums\UserRole;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Http\Services\Traits\ForwardCallToEloquentRepository;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    use ForwardCallToEloquentRepository;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(UserRequest $request, string $id)
    {
        $this->userRepository->where('id', $id)->update($request->only('name', 'role'));
    }

    public function delete(string $id)
    {
        $user = $this->userRepository->where('role', UserRole::Staff)
        ->where('id', $id)->first();

        if ($user) {
            $user->delete();
            return Response::HTTP_OK;
        }
        return Response::HTTP_BAD_REQUEST;
    }

}