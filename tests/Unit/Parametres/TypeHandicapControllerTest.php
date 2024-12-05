<?php

namespace Tests\Feature\Parametres;

use App\Models\TypeHandicap;
use App\Repositories\Parametres\TypeHandicapRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Exceptions\Parametres\TypeHandicapAlreadyExisteException;

class TypeHandicapControllerTest extends TestCase
{
    use DatabaseTransactions; 

    protected $typeHandicapRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->typeHandicapRepository = new TypeHandicapRepository(new TypeHandicap);
    }

    public function test_paginate()
    {
        $now = \Carbon\Carbon::now();

        $typeHandicapData = [
            'nom' => 'Test',
            'description' => 'description type handicap test',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $typeHandicap = $this->typeHandicapRepository->create($typeHandicapData);
        $typeHandicapIndex = $this->typeHandicapRepository->paginate();
        $this->assertNotNull($typeHandicapIndex);

    }

    public function test_typeHandicapNotExiste()
    {
        $now = \Carbon\Carbon::now();
    
        $typeHandicapData = [
            'nom' => 'Test',
            'description' => 'description type handicap test',
            'created_at' => $now,
            'updated_at' => $now,
        ];
    
        try {
            $typeHandicap = $this->typeHandicapRepository->create($typeHandicapData);
            $this->assertDatabaseHas('type_handicaps', ['nom' => 'Test']);
        } catch (\Exception $e) {
            $this->fail('Unexpected exception was thrown: ' . $e->getMessage());
        }
    }

    public function test_typeHandicapExiste(){

        $now = \Carbon\Carbon::now();

        $typeHandicapData = [
            'nom' => 'Test',
            'description' => 'description type handicap test',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $typeHandicap = $this->typeHandicapRepository->create($typeHandicapData);

        try {
            $typeHandicap = $this->typeHandicapRepository->create($typeHandicapData);
            $this->fail('Expected TypeHandicapException was not thrown');
        } catch (TypeHandicapAlreadyExisteException $e) {
            $this->assertEquals(__('models/models/typeHandicaps.typehandicap_already_existe'), $e->getMessage());
        } catch (\Exception $e) {
            $this->fail('Unexpected exception was thrown: ' . $e->getMessage());
        }

    }


    public function test_UpdateTypehandicap()
    {
       
        $now = \Carbon\Carbon::now();

        $typeHandicapData = [
            'nom' => 'Test',
            'description' => 'description type handicap test',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $typeHandicap = $this->typeHandicapRepository->create($typeHandicapData);
      
        $handicapUpdateData = [
            'nom' => 'test1',
            'description' => 'test',
        ];
        $this->typeHandicapRepository->update($handicapUpdateData,$typeHandicap->id);
        $this->assertDatabaseHas('type_handicaps', $handicapUpdateData);
    }

    public function test_DeleteTypehandicap()
    {
        $now = \Carbon\Carbon::now();

        $typeHandicapData = [
            'nom' => 'Test',
            'description' => 'description type handicap test',
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $typeHandicap = $this->typeHandicapRepository->create($typeHandicapData);
        $this->typeHandicapRepository->delete($typeHandicap->id);
        $this->assertDatabaseMissing('type_handicaps', ['id' => $typeHandicap->id]);
    }
    
    public function test_TypehandicapSearch()
    {
        $now = \Carbon\Carbon::now();
        $typeHandicapData = [
            'nom' => 'Test',
            'description' => 'description type handicap test',
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $typeHandicap = $this->typeHandicapRepository->create($typeHandicapData);
        $searchValue = 'Test'; 
        $searchResults = $this->typeHandicapRepository->all([$searchValue]);
        $this->assertTrue($searchResults->contains('nom', $searchValue));
    }
    
}
