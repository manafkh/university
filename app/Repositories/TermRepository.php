<?php

namespace App\Repositories;

use App\Models\Term;
use App\Repositories\BaseRepository;

/**
 * Class TermRepository
 * @package App\Repositories
 * @version March 25, 2019, 7:11 pm UTC
*/

class TermRepository extends BaseRepository
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
        return Term::class;
    }
}
