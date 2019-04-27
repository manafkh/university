<?php

namespace App\Repositories;

use App\Models\CourseEnrollment;
use App\Repositories\BaseRepository;

/**
 * Class CourseEnrollmentRepository
 * @package App\Repositories
 * @version March 24, 2019, 3:57 pm UTC
*/

class CourseEnrollmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'enrollment_id',
        'course_id',
        'term_id',
        'mid_grade',
        'th_Grade',
        'final_Grade'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CourseEnrollment::class;
    }
}
