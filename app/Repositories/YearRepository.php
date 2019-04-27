<?php

namespace App\Repositories;

use App\Models\Year;
use App\Repositories\BaseRepository;

/**
 * Class YearRepository
 * @package App\Repositories
 * @version March 25, 2019, 7:09 pm UTC
*/

class YearRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Year::class;
    }
}
