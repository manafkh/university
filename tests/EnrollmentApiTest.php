<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnrollmentApiTest extends TestCase
{
    use MakeEnrollmentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEnrollment()
    {
        $enrollment = $this->fakeEnrollmentData();
        $this->json('POST', '/api/v1/enrollments', $enrollment);

        $this->assertApiResponse($enrollment);
    }

    /**
     * @test
     */
    public function testReadEnrollment()
    {
        $enrollment = $this->makeEnrollment();
        $this->json('GET', '/api/v1/enrollments/'.$enrollment->id);

        $this->assertApiResponse($enrollment->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEnrollment()
    {
        $enrollment = $this->makeEnrollment();
        $editedEnrollment = $this->fakeEnrollmentData();

        $this->json('PUT', '/api/v1/enrollments/'.$enrollment->id, $editedEnrollment);

        $this->assertApiResponse($editedEnrollment);
    }

    /**
     * @test
     */
    public function testDeleteEnrollment()
    {
        $enrollment = $this->makeEnrollment();
        $this->json('DELETE', '/api/v1/enrollments/'.$enrollment->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/enrollments/'.$enrollment->id);

        $this->assertResponseStatus(404);
    }
}
