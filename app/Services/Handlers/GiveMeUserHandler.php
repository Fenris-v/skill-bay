<?php
namespace App\Services\Handlers;
use App\Models\User;
use App\Repositories\EloquentUserRepository;

class GiveMeUserHandler implements HandlerInterface
{
	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

    public function handle($id)
    {
    	return $this->userRepository->show($id);
    }
}
