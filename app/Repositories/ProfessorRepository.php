<?php

namespace App\Repositories;

use App\Models\Professor;
use App\Repositories\BaseRepository;

/**
 * Class ProfessorRepository
 * @package App\Repositories
 * @version March 16, 2019, 7:39 pm UTC
*/

class ProfessorRepository extends BaseRepository
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
        return Professor::class;
    }
}
