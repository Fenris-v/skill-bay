<?php
namespace App\Services;
use App\Services\Handlers\{CreateUserHandler, UpdateUserHandler, DeleteUserHandler, GiveMeUserHandler, GiveMeAllUserHandler};
class UserService{
	protected $createUserHandler;
    protected $updateUserHandler;
    protected $deleteUserHandler;
    protected $giveMeUserHandler;
    protected $giveMeAllUserHandler;

	public function __construct(CreateUserHandler $createUserHandler, UpdateUserHandler $updateUserHandler, DeleteUserHandler $deleteUserHandler, GiveMeUserHandler $giveMeUserHandler, GiveMeAllUserHandler $giveMeAllUserHandler)
	{
        $this->createUserHandler = $createUserHandler;
        $this->updateUserHandler = $updateUserHandler;
        $this->deleteUserHandler = $deleteUserHandler;
        $this->giveMeUserHandler = $giveMeUserHandler;
        $this->giveMeAllUserHandler = $giveMeAllUserHandler;
	}

	public function createUser($data)
	{
		return $this->createUserHandler->handle($data);
	}
	
	public function updateUser($data, $id)
	{
		$this->updateUserHandler->handle($data, $id);
	}
	
	public function deleteUser($id)
	{
		$this->deleteUserHandler->handle($id);
	}
	
	public function getUsers()
	{
		return $this->giveMeAllUserHandler->handle();
	}

	public function getUser($id)
	{
		return $this->giveMeUserHandler->handle($id);
	}
}
