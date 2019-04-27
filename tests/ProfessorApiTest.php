<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfessorApiTest extends TestCase
{
    use MakeProfessorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProfessor()
    {
        $professor = $this->fakeProfessorData();
        $this->json('POST', '/api/v1/professors', $professor);

        $this->assertApiResponse($professor);
    }

    /**
     * @test
     */
    public function testReadProfessor()
    {
        $professor = $this->makeProfessor();
        $this->json('GET', '/api/v1/professors/'.$professor->id);

        $this->assertApiResponse($professor->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProfessor()
    {
        $professor = $this->makeProfessor();
        $editedProfessor = $this->fakeProfessorData();

        $this->json('PUT', '/api/v1/professors/'.$professor->id, $editedProfessor);

        $this->assertApiResponse($editedProfessor);
    }

    /**
     * @test
     */
    public function testDeleteProfessor()
    {
        $professor = $this->makeProfessor();
        $this->json('DELETE', '/api/v1/professors/'.$professor->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/professors/'.$professor->id);

        $this->assertResponseStatus(404);
    }
}
