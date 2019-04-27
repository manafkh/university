<?php

use Faker\Factory as Faker;
use App\Models\CourseEnrollment;
use App\Repositories\CourseEnrollmentRepository;

trait MakeCourseEnrollmentTrait
{
    /**
     * Create fake instance of CourseEnrollment and save it in database
     *
     * @param array $courseEnrollmentFields
     * @return CourseEnrollment
     */
    public function makeCourseEnrollment($courseEnrollmentFields = [])
    {
        /** @var CourseEnrollmentRepository $courseEnrollmentRepo */
        $courseEnrollmentRepo = App::make(CourseEnrollmentRepository::class);
        $theme = $this->fakeCourseEnrollmentData($courseEnrollmentFields);
        return $courseEnrollmentRepo->create($theme);
    }

    /**
     * Get fake instance of CourseEnrollment
     *
     * @param array $courseEnrollmentFields
     * @return CourseEnrollment
     */
    public function fakeCourseEnrollment($courseEnrollmentFields = [])
    {
        return new CourseEnrollment($this->fakeCourseEnrollmentData($courseEnrollmentFields));
    }

    /**
     * Get fake data of CourseEnrollment
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCourseEnrollmentData($courseEnrollmentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'enrollment_id' => $fake->randomDigitNotNull,
            'course_id' => $fake->randomDigitNotNull,
            'mid_grade' => $fake->randomDigitNotNull,
            'th_Grade' => $fake->randomDigitNotNull,
            'final_Grade' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $courseEnrollmentFields);
    }
}
