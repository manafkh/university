<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseEnrollmentApiTest extends TestCase
{
    use MakeCourseEnrollmentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCourseEnrollment()
    {
        $courseEnrollment = $this->fakeCourseEnrollmentData();
        $this->json('POST', '/api/v1/courseEnrollments', $courseEnrollment);

        $this->assertApiResponse($courseEnrollment);
    }

    /**
     * @test
     */
    public function testReadCourseEnrollment()
    {
        $courseEnrollment = $this->makeCourseEnrollment();
        $this->json('GET', '/api/v1/courseEnrollments/'.$courseEnrollment->id);

        $this->assertApiResponse($courseEnrollment->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCourseEnrollment()
    {
        $courseEnrollment = $this->makeCourseEnrollment();
        $editedCourseEnrollment = $this->fakeCourseEnrollmentData();

        $this->json('PUT', '/api/v1/courseEnrollments/'.$courseEnrollment->id, $editedCourseEnrollment);

        $this->assertApiResponse($editedCourseEnrollment);
    }

    /**
     * @test
     */
    public function testDeleteCourseEnrollment()
    {
        $courseEnrollment = $this->makeCourseEnrollment();
        $this->json('DELETE', '/api/v1/courseEnrollments/'.$courseEnrollment->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/courseEnrollments/'.$courseEnrollment->id);

        $this->assertResponseStatus(404);
    }
}
