<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ScheduleTask
 * @package App\Models
 * @version March 21, 2019, 12:33 pm UTC
 *
 * @property date start_academicYear
 * @property date end_academicYear
 * @property date start_enroll
 * @property date end_enroll
 */
class ScheduleTask extends Model
{
    use SoftDeletes;

    public $table = 'schedule_tasks';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'start_academicYear',
        'end_academicYear',
        'start_enroll',
        'end_enroll'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_academicYear' => 'date',
        'end_academicYear' => 'date',
        'start_enroll' => 'date',
        'end_enroll' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'start_academicYear' => 'required',
        'end_academicYear' => 'required',
        'start_enroll' => 'required',
        'end_enroll' => 'required'
    ];

    
}
