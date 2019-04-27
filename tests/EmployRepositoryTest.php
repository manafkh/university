<?php

use App\Models\Employ;
use App\Repositories\EmployRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmployRepositoryTest extends TestCase
{
    use MakeEmployTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmployRepository
     */
    protected $employRepo;

    public function setUp()
    {
        parent::setUp();
        $this->employRepo = App::make(EmployRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEmploy()
    {
        $employ = $this->fakeEmployData();
        $createdEmploy = $this->employRepo->create($employ);
        $createdEmploy = $createdEmploy->toArray();
        $this->assertArrayHasKey('id', $createdEmploy);
        $this->assertNotNull($createdEmploy['id'], 'Created Employ must have id specified');
        $this->assertNotNull(Employ::find($createdEmploy['id']), 'Employ with given id must be in DB');
        $this->assertModelData($employ, $createdEmploy);
    }

    /**
     * @test read
     */
    public function testReadEmploy()
    {
        $employ = $this->makeEmploy();
        $dbEmploy = $this->employRepo->find($employ->id);
        $dbEmploy = $dbEmploy->toArray();
        $this->assertModelData($employ->toArray(), $dbEmploy);
    }

    /**
     * @test update
     */
    public function testUpdateEmploy()
    {
        $employ = $this->makeEmploy();
        $fakeEmploy = $this->fakeEmployData();
        $updatedEmploy = $this->employRepo->update($fakeEmploy, $employ->id);
        $this->assertModelData($fakeEmploy, $updatedEmploy->toArray());
        $dbEmploy = $this->employRepo->find($employ->id);
        $this->assertModelData($fakeEmploy, $dbEmploy->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEmploy()
    {
        $employ = $this->makeEmploy();
        $resp = $this->employRepo->delete($employ->id);
        $this->assertTrue($resp);
        $this->assertNull(Employ::find($employ->id), 'Employ should not exist in DB');
    }
}
