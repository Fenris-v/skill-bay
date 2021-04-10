<?php
namespace App\Services\Handlers;
use App\Models\User;
use App\Repositories\EloquentUserRepository;

class GiveMeAllUserHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

    public function handle()
    {
    	return $this->userRepository->all();
    }
}
