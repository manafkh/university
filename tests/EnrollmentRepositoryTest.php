<?php

use App\Models\Enrollment;
use App\Repositories\EnrollmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnrollmentRepositoryTest extends TestCase
{
    use MakeEnrollmentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EnrollmentRepository
     */
    protected $enrollmentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->enrollmentRepo = App::make(EnrollmentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEnrollment()
    {
        $enrollment = $this->fakeEnrollmentData();
        $createdEnrollment = $this->enrollmentRepo->create($enrollment);
        $createdEnrollment = $createdEnrollment->toArray();
        $this->assertArrayHasKey('id', $createdEnrollment);
        $this->assertNotNull($createdEnrollment['id'], 'Created Enrollment must have id specified');
        $this->assertNotNull(Enrollment::find($createdEnrollment['id']), 'Enrollment with given id must be in DB');
        $this->assertModelData($enrollment, $createdEnrollment);
    }

    /**
     * @test read
     */
    public function testReadEnrollment()
    {
        $enrollment = $this->makeEnrollment();
        $dbEnrollment = $this->enrollmentRepo->find($enrollment->id);
        $dbEnrollment = $dbEnrollment->toArray();
        $this->assertModelData($enrollment->toArray(), $dbEnrollment);
    }

    /**
     * @test update
     */
    public function testUpdateEnrollment()
    {
        $enrollment = $this->makeEnrollment();
        $fakeEnrollment = $this->fakeEnrollmentData();
        $updatedEnrollment = $this->enrollmentRepo->update($fakeEnrollment, $enrollment->id);
        $this->assertModelData($fakeEnrollment, $updatedEnrollment->toArray());
        $dbEnrollment = $this->enrollmentRepo->find($enrollment->id);
        $this->assertModelData($fakeEnrollment, $dbEnrollment->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEnrollment()
    {
        $enrollment = $this->makeEnrollment();
        $resp = $this->enrollmentRepo->delete($enrollment->id);
        $this->assertTrue($resp);
        $this->assertNull(Enrollment::find($enrollment->id), 'Enrollment should not exist in DB');
    }
}
