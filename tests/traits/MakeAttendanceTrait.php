<?php

use Faker\Factory as Faker;
use App\Models\Attendance;
use App\Repositories\AttendanceRepository;

trait MakeAttendanceTrait
{
    /**
     * Create fake instance of Attendance and save it in database
     *
     * @param array $attendanceFields
     * @return Attendance
     */
    public function makeAttendance($attendanceFields = [])
    {
        /** @var AttendanceRepository $attendanceRepo */
        $attendanceRepo = App::make(AttendanceRepository::class);
        $theme = $this->fakeAttendanceData($attendanceFields);
        return $attendanceRepo->create($theme);
    }

    /**
     * Get fake instance of Attendance
     *
     * @param array $attendanceFields
     * @return Attendance
     */
    public function fakeAttendance($attendanceFields = [])
    {
        return new Attendance($this->fakeAttendanceData($attendanceFields));
    }

    /**
     * Get fake data of Attendance
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAttendanceData($attendanceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'student_id' => $fake->randomDigitNotNull,
            'lecture_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $attendanceFields);
    }
}
