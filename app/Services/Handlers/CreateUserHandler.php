<?php
namespace App\Services\Handlers;
use App\Models\User;
use App\Repositories\EloquentUserRepository;

class CreateUserHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

    public function handle($data)
    {
      	return $this->userRepository->create($data);
    }
}
