<?php

use App\Models\CourseEnrollment;
use App\Repositories\CourseEnrollmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseEnrollmentRepositoryTest extends TestCase
{
    use MakeCourseEnrollmentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CourseEnrollmentRepository
     */
    protected $courseEnrollmentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->courseEnrollmentRepo = App::make(CourseEnrollmentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCourseEnrollment()
    {
        $courseEnrollment = $this->fakeCourseEnrollmentData();
        $createdCourseEnrollment = $this->courseEnrollmentRepo->create($courseEnrollment);
        $createdCourseEnrollment = $createdCourseEnrollment->toArray();
        $this->assertArrayHasKey('id', $createdCourseEnrollment);
        $this->assertNotNull($createdCourseEnrollment['id'], 'Created CourseEnrollment must have id specified');
        $this->assertNotNull(CourseEnrollment::find($createdCourseEnrollment['id']), 'CourseEnrollment with given id must be in DB');
        $this->assertModelData($courseEnrollment, $createdCourseEnrollment);
    }

    /**
     * @test read
     */
    public function testReadCourseEnrollment()
    {
        $courseEnrollment = $this->makeCourseEnrollment();
        $dbCourseEnrollment = $this->courseEnrollmentRepo->find($courseEnrollment->id);
        $dbCourseEnrollment = $dbCourseEnrollment->toArray();
        $this->assertModelData($courseEnrollment->toArray(), $dbCourseEnrollment);
    }

    /**
     * @test update
     */
    public function testUpdateCourseEnrollment()
    {
        $courseEnrollment = $this->makeCourseEnrollment();
        $fakeCourseEnrollment = $this->fakeCourseEnrollmentData();
        $updatedCourseEnrollment = $this->courseEnrollmentRepo->update($fakeCourseEnrollment, $courseEnrollment->id);
        $this->assertModelData($fakeCourseEnrollment, $updatedCourseEnrollment->toArray());
        $dbCourseEnrollment = $this->courseEnrollmentRepo->find($courseEnrollment->id);
        $this->assertModelData($fakeCourseEnrollment, $dbCourseEnrollment->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCourseEnrollment()
    {
        $courseEnrollment = $this->makeCourseEnrollment();
        $resp = $this->courseEnrollmentRepo->delete($courseEnrollment->id);
        $this->assertTrue($resp);
        $this->assertNull(CourseEnrollment::find($courseEnrollment->id), 'CourseEnrollment should not exist in DB');
    }
}
