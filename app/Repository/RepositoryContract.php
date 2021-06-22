<?php
namespace App\Repository;
use App\Models\User;

interface RepositoryContract
{
    public function all();

    public function create(array $data);

    public function update(array $data, User $user);

    public function delete($id);

    public function show($id);
}
