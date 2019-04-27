<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class AttendanceApiTest extends TestCase
{
    use MakeAttendanceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAttendance()
    {
        $attendance = $this->fakeAttendanceData();
        $this->json('POST', '/api/v1/attendances', $attendance);

        $this->assertApiResponse($attendance);
    }

    /**
     * @test
     */
    public function testReadAttendance()
    {
        $attendance = $this->makeAttendance();
        $this->json('GET', '/api/v1/attendances/'.$attendance->id);

        $this->assertApiResponse($attendance->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAttendance()
    {
        $attendance = $this->makeAttendance();
        $editedAttendance = $this->fakeAttendanceData();

        $this->json('PUT', '/api/v1/attendances/'.$attendance->id, $editedAttendance);

        $this->assertApiResponse($editedAttendance);
    }

    /**
     * @test
     */
    public function testDeleteAttendance()
    {
        $attendance = $this->makeAttendance();
        $this->json('DELETE', '/api/v1/attendances/'.$attendance->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/attendances/'.$attendance->id);

        $this->assertResponseStatus(404);
    }
}
