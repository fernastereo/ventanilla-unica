<?php

namespace App\Interfaces\Services;

interface RequestTypeServiceInterface{
    public function getAllRequestTypes(array $filters = [], ?int $perPage = null);
    public function createRequestType(array $data);
    public function updateRequestType(int $id, array $data);
    public function deleteRequestType(int $id);
    public function getRequestTypeById($id);
}
