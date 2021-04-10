<?php
namespace App\Services\Handlers;
use App\Models\User;
use App\Repositories\EloquentUserRepository;

class UpdateUserHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

    public function handle($data, int $id)
    {
    	return $this->userRepository->update($data, $id);
    }
}
