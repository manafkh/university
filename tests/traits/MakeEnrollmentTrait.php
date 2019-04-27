<?php

use Faker\Factory as Faker;
use App\Models\Enrollment;
use App\Repositories\EnrollmentRepository;

trait MakeEnrollmentTrait
{
    /**
     * Create fake instance of Enrollment and save it in database
     *
     * @param array $enrollmentFields
     * @return Enrollment
     */
    public function makeEnrollment($enrollmentFields = [])
    {
        /** @var EnrollmentRepository $enrollmentRepo */
        $enrollmentRepo = App::make(EnrollmentRepository::class);
        $theme = $this->fakeEnrollmentData($enrollmentFields);
        return $enrollmentRepo->create($theme);
    }

    /**
     * Get fake instance of Enrollment
     *
     * @param array $enrollmentFields
     * @return Enrollment
     */
    public function fakeEnrollment($enrollmentFields = [])
    {
        return new Enrollment($this->fakeEnrollmentData($enrollmentFields));
    }

    /**
     * Get fake data of Enrollment
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEnrollmentData($enrollmentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'academicYear' => $fake->randomDigitNotNull,
            'ExamNumber' => $fake->randomDigitNotNull,
            'student_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $enrollmentFields);
    }
}
