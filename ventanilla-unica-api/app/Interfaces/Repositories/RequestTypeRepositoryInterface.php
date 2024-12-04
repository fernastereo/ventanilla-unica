<?php

namespace App\Interfaces\Repositories;

interface RequestTypeRepositoryInterface{
    public function getAll(array $filters = []);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function findById(int $id);
    public function paginate(array $filters = [], int $perPage);
}
