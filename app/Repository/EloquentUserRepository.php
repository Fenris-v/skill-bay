<?php
namespace App\Repository;

use App\Models\User;

class EloquentUserRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    public function __construct(User $user){
        $this->model = $user;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, User $user)
    {
        $user->update($data);
        return $user;
    }
    //update several records
    public function updateSeveral(array $data, array $id){
        $records = $this->model->find($id);
        foreach($records as $theRecord){
            $theRecord->update($data);
        }
        return $records;
    }

    // remove record from the database
    public function delete($id)
    {
        $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
    
    public function getById(int $id, array $columns = ['*']): User
    {
        return $this->model->where('id', $id)->first($columns);
    }
}
