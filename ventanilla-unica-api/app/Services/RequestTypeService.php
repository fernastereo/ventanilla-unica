<?php

namespace App\Services;

use App\Interfaces\Services\RequestTypeServiceInterface;
use App\Interfaces\Repositories\RequestTypeRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\UniqueConstraintViolationException;
use RuntimeException;

class RequestTypeService implements RequestTypeServiceInterface
{
    protected $repository;

    public function __construct(RequestTypeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllRequestTypes(array $filters = [], ?int $perPage = null)
    {
        if ($perPage) {
            return $this->repository->paginate($filters, $perPage);
        }
        return $this->repository->getAll($filters);
    }

    public function getRequestTypeById($id)
    {
        return $this->repository->findById($id);
    }

    public function createRequestType(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateRequestType($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteRequestType($id)
    {
        return $this->repository->delete($id);
    }
}
