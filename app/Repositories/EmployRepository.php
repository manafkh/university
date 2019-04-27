<?php

namespace App\Repositories;

use App\Models\Employ;
use App\Repositories\BaseRepository;

/**
 * Class EmployRepository
 * @package App\Repositories
 * @version April 13, 2019, 2:02 pm UTC
*/

class EmployRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
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
        return Employ::class;
    }
}
