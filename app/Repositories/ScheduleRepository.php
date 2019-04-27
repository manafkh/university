<?php

namespace App\Repositories;

use App\Models\Schedule;
use App\Repositories\BaseRepository;

/**
 * Class ScheduleRepository
 * @package App\Repositories
 * @version March 18, 2019, 4:18 pm UTC
*/

class ScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'day',
        'start_time',
        'end_time'
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
        return Schedule::class;
    }
}
