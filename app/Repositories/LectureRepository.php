<?php

namespace App\Repositories;

use App\Models\Lecture;
use App\Repositories\BaseRepository;

/**
 * Class LectureRepository
 * @package App\Repositories
 * @version March 19, 2019, 5:23 pm UTC
*/

class LectureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'subject',
        'section_id',
        'qrcode_path'
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
        return Lecture::class;
    }
}
