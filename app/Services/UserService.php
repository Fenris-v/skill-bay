<?php
namespace App\Services;

use App\Services\Handlers\{CreateUserHandler, UpdateUserHandler, DeleteUserHandler, GiveMeUserHandler, GiveMeAllUserHandler};
use Illuminate\Support\Facades\Hash;
use App\Repositories\EloquentUserRepository;

class UserService{
	protected $userRepository;

	private $userRepository;

	public function __construct(EloquentUserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

	public function registerUser($data)
	{
		$data['password'] = Hash::make($data['password']);
		return $this->userRepository->create($data);
	}
	
	public function updateUser($data, $id)
	{
		return $this->userRepository->update($data, $id);
	}
	
	public function deleteUser($id)
	{
		return $this->userRepository->delete($id);
	}
	
	public function getUsers()
	{
		return $this->userRepository->all();
	}

	public function getUser($id)
	{
		return $this->userRepository->show($id);
	}
}
