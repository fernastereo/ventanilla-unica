<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\Services\RequestTypeServiceInterface;

class RequestTypeController extends Controller
{
    protected $requestTypeService;

    public function __construct(RequestTypeServiceInterface $requestTypeService)
    {
        $this->requestTypeService = $requestTypeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->query('filters', []);
        $perPage = $request->query('per_page', null);

        $requestTypes = $this->requestTypeService->getAllRequestTypes($filters, $perPage);
        return response()->json($requestTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'active' => 'required|boolean',
        ]);

        $requestTpe = $this->requestTypeService->createRequestType($data);
        return response()->json($requestTpe, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $requestType = $this->requestTypeService->getRequestTypeById($id);
        return response()->json($requestType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'active' => 'required|boolean',
        ]);

        $requestTpe = $this->requestTypeService->updateRequestType($id, $data);
        return response()->json($requestTpe, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $requestType = $this->requestTypeService->deleteRequestType($id);
        return response()->json($requestType, 204);
    }
}
