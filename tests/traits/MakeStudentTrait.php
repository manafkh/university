<?php

use Faker\Factory as Faker;
use App\Models\Student;
use App\Repositories\StudentRepository;

trait MakeStudentTrait
{
    /**
     * Create fake instance of Student and save it in database
     *
     * @param array $studentFields
     * @return Student
     */
    public function makeStudent($studentFields = [])
    {
        /** @var StudentRepository $studentRepo */
        $studentRepo = App::make(StudentRepository::class);
        $theme = $this->fakeStudentData($studentFields);
        return $studentRepo->create($theme);
    }

    /**
     * Get fake instance of Student
     *
     * @param array $studentFields
     * @return Student
     */
    public function fakeStudent($studentFields = [])
    {
        return new Student($this->fakeStudentData($studentFields));
    }

    /**
     * Get fake data of Student
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStudentData($studentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'first_name' => $fake->word,
            'last_name' => $fake->word,
            'father_name' => $fake->word,
            'mother_name' => $fake->word,
            'phone' => $fake->randomDigitNotNull,
            'email' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $studentFields);
    }
}
