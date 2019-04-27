<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CourseEnrollment
 * @package App\Models
 * @version March 24, 2019, 3:57 pm UTC
 *
 * @property integer enrollment_id
 * @property integer course_id
 * @property integer mid_grade
 * @property integer th_Grade
 * @property integer final_Grade
 */
class CourseEnrollment extends Pivot
{
    use SoftDeletes;

    public $table = 'course_enrollment';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'enrollment_id',
        'course_id',
        'term_id',
        'mid_grade',
        'th_Grade',
        'final_Grade',
        'enroll_year'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'enrollment_id' => 'integer',
        'course_id' => 'integer',
        'term_id' => 'integer',
        'mid_grade' => 'integer',
        'th_Grade' => 'integer',
        'final_Grade' => 'integer',
        'enroll_year' => 'year'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'enrollment_id' => 'required',
        'course_id' => 'required',
        'term_id' => 'required',
        'mid_grade' => 'required',
        'th_Grade' => 'required',
        'final_Grade' => 'required',
        'enroll_year' => 'required'
    ];

    public function course(){

        return $this->belongsTo(Course::class);
    }

    public function enrollment(){

        return $this->belongsTo(Enrollment::class);
    }

    
}
