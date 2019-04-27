<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;
use MakeEmployTrait;
class EmployApiTest extends TestCase
{
    use MakeEmployTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEmploy()
    {
        $employ = $this->fakeEmployData();
        $this->json('POST', '/api/v1/employs', $employ);

        $this->assertApiResponse($employ);
    }

    /**
     * @test
     */
    public function testReadEmploy()
    {
        $employ = $this->makeEmploy();
        $this->json('GET', '/api/v1/employs/'.$employ->id);

        $this->assertApiResponse($employ->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEmploy()
    {
        $employ = $this->makeEmploy();
        $editedEmploy = $this->fakeEmployData();

        $this->json('PUT', '/api/v1/employs/'.$employ->id, $editedEmploy);

        $this->assertApiResponse($editedEmploy);
    }

    /**
     * @test
     */
    public function testDeleteEmploy()
    {
        $employ = $this->makeEmploy();
        $this->json('DELETE', '/api/v1/employs/'.$employ->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/employs/'.$employ->id);

        $this->assertResponseStatus(404);
    }
}
