<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Enrollment
 * @package App\Models
 * @version March 16, 2019, 3:53 pm UTC
 *
 * @property integer academicYear
 * @property integer ExamNumber
 * @property integer student_id
 */
class Enrollment extends Model
{
    use SoftDeletes;

    public $table = 'enrollments';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'year_id',
        'ExamNumber',
        'student_id',
        'enroll_year'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'year_id' => 'integer',
        'ExamNumber' => 'integer',
        'student_id' => 'integer',
        'enroll_year'=> 'year'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'year_id' => 'numeric| required',

    ];

    public function courses(){

        return $this->belongsToMany(Course::class);
    }
    public function year(){
        return $this->belongsTo(Year::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }

    
}
