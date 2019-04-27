<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\BaseRepository;

/**
 * Class StudentRepository
 * @package App\Repositories
 * @version March 16, 2019, 3:43 pm UTC
*/

class StudentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'phone',
        'email'
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
        return Student::class;
    }
}
