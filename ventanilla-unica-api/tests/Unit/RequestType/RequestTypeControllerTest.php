<?php

namespace Tests\Unit\RequestType;

use Mockery;
use Tests\TestCase;
use App\Models\RequestType;
use Illuminate\Http\Response;
use App\Interfaces\Services\RequestTypeServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class RequestTypeControllerTest extends TestCase
{
    protected $requestTypeServiceMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->requestTypeServiceMock = Mockery::mock(RequestTypeServiceInterface::class);
        $this->app->instance(RequestTypeServiceInterface::class, $this->requestTypeServiceMock);
    }

    public function test_it_can_get_all_request_types()
    {
        $requestTypes = collect([
            new RequestType(['id' => 1, 'name' => 'Request Type 1', 'description' => 'Description 1', 'active' => true]),
            new RequestType(['id' => 2, 'name' => 'Request Type 2', 'description' => 'Description 2', 'active' => true]),
            new RequestType(['id' => 3, 'name' => 'Request Type 3', 'description' => 'Description 3', 'active' => true]),
        ]);

        $this->requestTypeServiceMock
            ->shouldReceive('getAllRequestTypes')
            ->once()
            ->andReturn($requestTypes);

        $response = $this->getJson(route('requesttypes.index'));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(3)
            ->assertJsonFragment(['name' => 'Request Type 1'])
            ->assertJsonFragment(['name' => 'Request Type 2'])
            ->assertJsonFragment(['name' => 'Request Type 3']);
    }

    public function test_it_returns_and_empty_list_when_no_request_types_exist()
    {
        $this->requestTypeServiceMock
            ->shouldReceive('getAllRequestTypes')
            ->once()
            ->andReturn(collect([]));

        $response = $this->getJson(route('requesttypes.index'));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(0);
    }

    public function test_it_can_show_a_single_request_type()
    {
        $requestType = new RequestType(['id' => 1, 'name' => 'Request Type 1', 'description' => 'Description 1', 'active' => true]);

        $this->requestTypeServiceMock
            ->shouldReceive('getRequestTypeById')
            ->once()
            ->with(1)
            ->andReturn($requestType);

        $response = $this->getJson(route('requesttypes.show', 1));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($requestType->toArray());
    }

    public function test_it_returns_404_when_one_request_type_is_not_found()
    {
        $this->requestTypeServiceMock
            ->shouldReceive('getRequestTypeById')
            ->once()
            ->with(999)
            ->andThrow(new ModelNotFoundException());

        $response = $this->getJson(route('requesttypes.show', 999));

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_it_can_return_paginated_request_types()
    {
        $paginatedResults = new LengthAwarePaginator(
            collect([
                new RequestType(['id' => 1, 'name' => 'Request Type 1', 'description' => 'Description 1', 'active' => true]),
                new RequestType(['id' => 2, 'name' => 'Request Type 2', 'description' => 'Description 2', 'active' => true]),
                new RequestType(['id' => 3, 'name' => 'Request Type 3', 'description' => 'Description 3', 'active' => true]),
            ]), 3, 2
        );

        $this->requestTypeServiceMock
            ->shouldReceive('getAllRequestTypes')
            ->once()
            ->with([], 2)
            ->andReturn($paginatedResults);

        $response = $this->getJson(route('requesttypes.index', ['per_page' => 2]));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['name', 'description', 'active']
                ],
                'current_page',
                'last_page',
                'per_page',
                'total'
            ]);
    }

    public function test_it_can_filter_request_types()
    {
        $filters = ['active' => true, 'name' => 'Special'];

        $filteredResults = collect([
            new RequestType(['name' => 'Special Request Type'])
        ]);

        $this->requestTypeServiceMock
            ->shouldReceive('getAllRequestTypes')
            ->once()
            ->with($filters, null)
            ->andReturn($filteredResults);

        $response = $this->getJson(route('requesttypes.index', ['filters' => $filters]));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount(1)
            ->assertJsonFragment(['name' => 'Special Request Type']);
    }

    public function test_it_can_create_a_request_type()
    {
        $data = [
            'name' => 'Request Type 1',
            'description' => 'Description 1',
            'active' => true,
        ];

        $requestType = new RequestType($data);

        $this->requestTypeServiceMock
            ->shouldReceive('createRequestType')
            ->once()
            ->with($data)
            ->andReturn($requestType);

        $response = $this->postJson(route('requesttypes.store'), $data);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($data);
    }

    public function test_it_validates_request_type_on_creation()
    {
        $invalidData = [
            'name' => ''
        ];

        $response = $this->postJson(route('requesttypes.store'), $invalidData);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_it_can_update_a_request_type()
    {
        $updateData = [
            'name' => 'Updated Request Type 1',
            'description' => 'Description 1',
            'active' => true,
        ];

        $updatedRequestType = new RequestType($updateData);

        $this->requestTypeServiceMock
            ->shouldReceive('updateRequestType')
            ->once()
            ->with(1, $updateData)
            ->andReturn($updatedRequestType);

        $response = $this->putJson(route('requesttypes.update', 1), $updateData);

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson($updateData);
    }

    public function test_it_validates_request_type_on_update()
    {
        $invalidData = [
            'name' => ''
        ];

        $response = $this->putJson(route('requesttypes.update', 1), $invalidData);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_it_can_delete_a_request_type()
    {
        $requestType = new RequestType([
            'id' => 1,
            'name' => 'Request Type 1',
            'description' => 'Description 1',
            'active' => true,
        ]);

        $this->requestTypeServiceMock
            ->shouldReceive('deleteRequestType')
            ->once()
            ->with(1)
            ->andReturn($requestType);

        $response = $this->deleteJson(route('requesttypes.destroy', 1));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

    }
}
