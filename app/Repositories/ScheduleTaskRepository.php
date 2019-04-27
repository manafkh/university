<?php

namespace App\Repositories;

use App\Models\ScheduleTask;
use App\Repositories\BaseRepository;

/**
 * Class ScheduleTaskRepository
 * @package App\Repositories
 * @version March 21, 2019, 12:33 pm UTC
*/

class ScheduleTaskRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'start_academicYear',
        'end_academicYear',
        'start_enroll',
        'end_enroll'
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
        return ScheduleTask::class;
    }
}
