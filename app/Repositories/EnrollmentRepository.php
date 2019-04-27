<?php

namespace App\Repositories;

use App\Models\Enrollment;
use App\Repositories\BaseRepository;

/**
 * Class EnrollmentRepository
 * @package App\Repositories
 * @version March 16, 2019, 3:53 pm UTC
*/

class EnrollmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'year_id',
        'ExamNumber'
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
        return Enrollment::class;
    }
}
