<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LectureApiTest extends TestCase
{
    use MakeLectureTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLecture()
    {
        $lecture = $this->fakeLectureData();
        $this->json('POST', '/api/v1/lectures', $lecture);

        $this->assertApiResponse($lecture);
    }

    /**
     * @test
     */
    public function testReadLecture()
    {
        $lecture = $this->makeLecture();
        $this->json('GET', '/api/v1/lectures/'.$lecture->id);

        $this->assertApiResponse($lecture->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLecture()
    {
        $lecture = $this->makeLecture();
        $editedLecture = $this->fakeLectureData();

        $this->json('PUT', '/api/v1/lectures/'.$lecture->id, $editedLecture);

        $this->assertApiResponse($editedLecture);
    }

    /**
     * @test
     */
    public function testDeleteLecture()
    {
        $lecture = $this->makeLecture();
        $this->json('DELETE', '/api/v1/lectures/'.$lecture->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/lectures/'.$lecture->id);

        $this->assertResponseStatus(404);
    }
}
