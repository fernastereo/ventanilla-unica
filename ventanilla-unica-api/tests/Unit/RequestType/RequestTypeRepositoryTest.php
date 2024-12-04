<?php

namespace Tests\Unit\RequestType;

use App\Models\RequestType;
use Tests\TestCase;
use App\Repositories\RequestTypeRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestTypeRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new RequestTypeRepository();
    }

    public function test_it_can_get_all_request_types()
    {
        RequestType::factory()->count(5)->create();
        $requestTypes = $this->repository->getAll();

        $this->assertCount(5, $requestTypes);
    }

    public function test_it_can_get_paginated_request_types()
    {
        RequestType::factory()->count(10)->create();

        $paginatedRequestTypes = $this->repository->paginate([], 5);

        $this->assertCount(5, $paginatedRequestTypes->items());
        $this->assertEquals(10, $paginatedRequestTypes->total());
        $this->assertEquals(2, $paginatedRequestTypes->lastPage());
    }

    public function test_it_can_get_a_request_type_by_id()
    {
        //crea un registro
        $requestType = RequestType::factory()->create();
        //busca el registro creado por id usando el repositorio
        $foundRequestType = $this->repository->findById($requestType->id);
        //compara si el registro encontrado es igual al registro creado
        $this->assertEquals($requestType->id, $foundRequestType->id);
        $this->assertEquals($requestType->name, $foundRequestType->name);
        $this->assertEquals($requestType->description, $foundRequestType->description);
    }

    public function test_it_can_get_a_request_type_by_specific_conditions()
    {
        $targetRequestType = RequestType::factory()->create([
            'name' => 'Request Type 1',
            'description' => 'Request Type 1 Description',
            'active' => true,
        ]);
        RequestType::factory()->count(4)->create();

        $foundRequestType = $this->repository->getAll([
            'name' => 'Request Type 1'
        ]);

        $this->assertCount(1, $foundRequestType);
        $this->assertEquals($targetRequestType->id, $foundRequestType->first()->id);
    }

    public function test_it_returns_an_empty_collection_when_no_request_type_exists_on_db()
    {
        $requestTypes = $this->repository->getAll();

        $this->assertCount(0, $requestTypes);
    }

    public function test_it_returns_null_when_no_request_type_matches_condition()
    {
        RequestType::factory()->count(5)->create();

        $notFoundRequestType = $this->repository->getAll([
            'name' => 'Non Existent Request Type'
        ]);

        $this->assertEmpty($notFoundRequestType);
        $this->assertNull($notFoundRequestType->first());
    }

    public function test_it_can_create_a_single_request_type()
    {
        $data = [
            'name' => 'Request Type 1',
            'description' => 'Request Type 1 Description',
            'active' => true,
        ];

        $creratedRequestType = $this->repository->create($data);

        $this->assertDatabaseHas('request_types', $data);
        $this->assertEquals($data['name'], $creratedRequestType->name);
    }

    public function test_it_can_update_an_existing_request_type()
    {
        $requestType = RequestType::factory()->create();

        $data = [
            'name' => 'Updated Request Type',
            'description' => 'Updated Request Type Description',
            'active' => false,
        ];

        $updatedRequestType = $this->repository->update($requestType->id, $data);

        $this->assertDatabaseHas('request_types', $data);
        $this->assertEquals($requestType->id, $updatedRequestType->id);
        $this->assertEquals($data['name'], $updatedRequestType->name);
    }

    public function test_it_can_delete_an_existing_request_type()
    {
        $requestType = RequestType::factory()->create();

        $deletedRequestType = $this->repository->delete($requestType->id);

        $this->assertDatabaseMissing('request_types', ['id' => $requestType->id]);
        $this->assertTrue($deletedRequestType);
    }

    // 6. Relationship Tests
    // public function test_it_can_load_related_models()
    // {
    //     // Assuming RequestType has a relationship with another model
    //     $requestType = RequestType::factory()
    //         ->has(RelatedModel::factory()->count(3))
    //         ->create();

    //     $foundRequestType = $this->repository->findById($requestType->id);

    //     $this->assertTrue($foundRequestType->relatedModels->isNotEmpty());
    //     $this->assertCount(3, $foundRequestType->relatedModels);
    // }

    // 8. Performance Considerations
    public function test_it_performs_efficiently_with_large_dataset()
    {
        // Create a large number of records
        RequestType::factory()->count(5000)->create();

        $startTime = microtime(true);
        $requestTypes = $this->repository->getAll();
        $endTime = microtime(true);

        $this->assertCount(5000, $requestTypes);

        // Adjust this threshold based on your performance requirements
        $this->assertLessThan(1, $endTime - $startTime, 'Query took too long');
    }
}
