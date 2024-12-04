<?php

namespace Tests\Unit\RequestType;

use Mockery;
use Tests\TestCase;
use App\Models\RequestType;
use App\Services\RequestTypeService;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\UniqueConstraintViolationException;
use App\Interfaces\Repositories\RequestTypeRepositoryInterface;

// use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestTypeServiceTest extends TestCase
{
    // use RefreshDatabase;

    protected $requestTypeRepositoryMock;
    protected $requestTypeService;

    protected function setUp(): void
    {
        parent::setUp();
        // Mock del repositorio
        $this->requestTypeRepositoryMock = Mockery::mock(RequestTypeRepositoryInterface::class);
    }

    public function test_it_can_get_all_request_types()
    {
        $expectedRequestTypes = collect([
            new RequestType(),
            new RequestType(),
            new RequestType(),
        ]);

        $this->requestTypeRepositoryMock
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($expectedRequestTypes);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->getAllRequestTypes();

        $this->assertEquals(3, $result->count());
        $this->assertEquals($expectedRequestTypes, $result);
    }

    public function test_it_can_get_paginated_request_types()
    {
        $paginatedRequestTypes = new \Illuminate\Pagination\LengthAwarePaginator(
            [new RequestType(), new RequestType(), new RequestType()],
            3,
            2,
            1
        );

        $this->requestTypeRepositoryMock
            ->shouldReceive('paginate')
            ->once()
            ->with([], 2)
            ->andReturn($paginatedRequestTypes);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->getAllRequestTypes([], 2);

        $this->assertCount(3, $result->items());
        $this->assertEquals(3, $result->total());
        $this->assertEquals(2, $result->perPage());
        $this->assertEquals(2, $result->lastPage());
    }

    public function test_it_can_get_a_request_type_by_id()
    {
        $expectedRequestType = new RequestType([
            'id' => 1,
            'name' => 'Request Type 1',
            'description' => 'Request Type 1 Description',
            'active' => true,
        ]);

        $this->requestTypeRepositoryMock
            ->shouldReceive('findById')
            ->once()
            ->with(1)
            ->andReturn($expectedRequestType);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->getRequestTypeById(1);

        $this->assertEquals($expectedRequestType, $result);
    }

    public function test_it_can_get_a_request_type_by_specific_conditions()
    {
        $expectedRequestType = collect([
            new RequestType([
                'id' => 1,
                'name' => 'Request Type 1',
                'description' => 'Request Type 1 Description',
                'active' => true,
            ])
        ]);

        $this->requestTypeRepositoryMock
            ->shouldReceive('getAll')
            ->once()
            ->with(['name' => 'Request Type 1'])
            ->andReturn($expectedRequestType);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->getAllRequestTypes(['name' => 'Request Type 1']);

        $this->assertEquals($expectedRequestType, $result);
    }

    public function test_it_can_create_a_single_request_type()
    {
        $data = [
            'name' => 'New Request Type',
            'description' => 'Test description',
            'active' => true
        ];

        $expectedRequestType = new RequestType($data);

        // Set up repository mock expectation
        $this->requestTypeRepositoryMock
            ->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn($expectedRequestType);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->createRequestType($data);

        $this->assertInstanceOf(RequestType::class, $result);
        $this->assertEquals($expectedRequestType, $result);
    }

    public function test_it_can_update_an_existing_request_type()
    {
        $updateData = [
            'name' => 'Updated Request Type',
            'description' => 'Updated description',
            'active' => false
        ];

        $expectedRequestType = new RequestType($updateData);

        $this->requestTypeRepositoryMock
            ->shouldReceive('update')
            ->once()
            ->with(1, $updateData)
            ->andReturn($expectedRequestType);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->updateRequestType(1, $updateData);

        $this->assertEquals($expectedRequestType, $result);
    }

    public function test_it_can_delete_an_existing_request_type()
    {
        $deletedData = [
            'id' => 1,
            'name' => 'Request Type 1',
            'description' => 'Request Type 1 Description',
            'active' => true,
        ];

        $this->requestTypeRepositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with(1)
            ->andReturn($deletedData);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->deleteRequestType(1);

        $this->assertEquals($deletedData, $result);
    }

    public function test_it_throws_an_exception_when_look_for_non_existing_request_type()
    {
        $nonExixtingId = 999;

        $this->requestTypeRepositoryMock
            ->shouldReceive('findById')
            ->once()
            ->with($nonExixtingId)
            ->andThrow(new ModelNotFoundException);

        $this->expectException(ModelNotFoundException::class);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $result = $this->requestTypeService->getRequestTypeById(999);
        $this->assertEmpty($result);
        $this->assertNull($result);

    }

    public function test_it_throws_an_exception_when_updating_non_existing_request_type()
    {
        $updateData = ['name' => 'Updated Request Type'];

        $expectedRequestType = new RequestType($updateData);

        $this->requestTypeRepositoryMock
            ->shouldReceive('update')
            ->once()
            ->with(999, $updateData)
            ->andThrow(new ModelNotFoundException);

        $this->expectException(ModelNotFoundException::class);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $this->requestTypeService->updateRequestType(999, $updateData);
    }

    public function test_it_throws_an_exception_when_deleting_non_existent_request_type()
    {
        $this->requestTypeRepositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with(999)
            ->andThrow(new ModelNotFoundException);

        $this->expectException(ModelNotFoundException::class);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $this->requestTypeService->deleteRequestType(999);
    }

    public function test_it_handles_empty_data_during_creation()
    {
        $data = [];

        // Set up repository mock expectation
        $this->requestTypeRepositoryMock
            ->shouldReceive('create')
            ->once()
            ->with($data)
            ->andThrow(new QueryException('Query Exception', '', [], new \Exception,));

        $this->expectException(QueryException::class);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $this->requestTypeService->createRequestType($data);
    }

    public function test_it_handles_unique_constraints_during_creation()
    {
        $data = ['name' => 'Request Type 1'];

        // Set up repository mock expectation
        $this->requestTypeRepositoryMock
            ->shouldReceive('create')
            ->once()
            ->with($data)
            ->andThrow(new UniqueConstraintViolationException('Unique Constraint Violation', '', [], new \Exception,));

        $this->expectException(UniqueConstraintViolationException::class);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $this->requestTypeService->createRequestType($data);
    }

    public function test_it_handles_unique_constraints_during_update()
    {
        $data = ['name' => 'Request Type 1'];

        // Set up repository mock expectation
        $this->requestTypeRepositoryMock
            ->shouldReceive('update')
            ->once()
            ->with(1, $data)
            ->andThrow(new UniqueConstraintViolationException('Unique Constraint Violation', '', [], new \Exception,));

        $this->expectException(UniqueConstraintViolationException::class);

        $this->requestTypeService = new RequestTypeService($this->requestTypeRepositoryMock);

        $this->requestTypeService->updateRequestType(1, $data);
    }
}
