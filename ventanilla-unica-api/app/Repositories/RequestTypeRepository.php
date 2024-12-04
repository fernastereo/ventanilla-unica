<?php

namespace App\Repositories;

use App\Models\RequestType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\Repositories\RequestTypeRepositoryInterface;

class RequestTypeRepository implements RequestTypeRepositoryInterface
{
	public function getAll(array $filters = [])
	{
        $requestType = RequestType::where($filters)->get();
        return $requestType;
	}

	public function create(array $data)
	{
        $requestType = RequestType::create($data);
		return $requestType;
	}

	public function update($id, array $data)
	{
        $requestType = RequestType::findOrFail($id);
        $requestType->update($data);
        return $requestType;
    }

	public function delete($id)
	{
        $requestType = RequestType::findOrFail($id);
        $requestType->delete();
        return true;
	}

	public function findById($id)
	{
        $requestType = RequestType::findOrFail($id);
		return $requestType;
	}

    public function paginate(array $filters = [], $numPages = 10)
    {
        $requestType = RequestType::where($filters)->paginate($numPages);
        return $requestType;
    }
}
