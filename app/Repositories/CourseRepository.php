<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\BaseRepository;

/**
 * Class CourseRepository
 * @package App\Repositories
 * @version March 17, 2019, 3:19 pm UTC
*/

class CourseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'term_id',
        'year_id'
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
        return Course::class;
    }
}
