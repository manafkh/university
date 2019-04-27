<?php

namespace App\Repositories;

use App\Models\Section;
use App\Repositories\BaseRepository;

/**
 * Class SectionRepository
 * @package App\Repositories
 * @version March 18, 2019, 4:23 pm UTC
*/

class SectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'course_id',
        'professor_id',
        'schedule_id',
        'Room'
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
        return Section::class;
    }
}
