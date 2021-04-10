<?php
namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete($id);

    public function show($id);
}
