<?php

use App\Models\Attendance;
use App\Repositories\AttendanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AttendanceRepositoryTest extends TestCase
{
    use MakeAttendanceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AttendanceRepository
     */
    protected $attendanceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->attendanceRepo = App::make(AttendanceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAttendance()
    {
        $attendance = $this->fakeAttendanceData();
        $createdAttendance = $this->attendanceRepo->create($attendance);
        $createdAttendance = $createdAttendance->toArray();
        $this->assertArrayHasKey('id', $createdAttendance);
        $this->assertNotNull($createdAttendance['id'], 'Created Attendance must have id specified');
        $this->assertNotNull(Attendance::find($createdAttendance['id']), 'Attendance with given id must be in DB');
        $this->assertModelData($attendance, $createdAttendance);
    }

    /**
     * @test read
     */
    public function testReadAttendance()
    {
        $attendance = $this->makeAttendance();
        $dbAttendance = $this->attendanceRepo->find($attendance->id);
        $dbAttendance = $dbAttendance->toArray();
        $this->assertModelData($attendance->toArray(), $dbAttendance);
    }

    /**
     * @test update
     */
    public function testUpdateAttendance()
    {
        $attendance = $this->makeAttendance();
        $fakeAttendance = $this->fakeAttendanceData();
        $updatedAttendance = $this->attendanceRepo->update($fakeAttendance, $attendance->id);
        $this->assertModelData($fakeAttendance, $updatedAttendance->toArray());
        $dbAttendance = $this->attendanceRepo->find($attendance->id);
        $this->assertModelData($fakeAttendance, $dbAttendance->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAttendance()
    {
        $attendance = $this->makeAttendance();
        $resp = $this->attendanceRepo->delete($attendance->id);
        $this->assertTrue($resp);
        $this->assertNull(Attendance::find($attendance->id), 'Attendance should not exist in DB');
    }
}
