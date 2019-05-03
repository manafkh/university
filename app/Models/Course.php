<?php

namespace App\Models;

use App\TermCourse;
use App\TermCourseStatus;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 * @package App\Models
 * @version March 17, 2019, 3:19 pm UTC
 *
 * @property string title
 * @property string description
 * @property string term
 * @property string Year
 */
class Course extends Model
{
    use SoftDeletes;

    public $table = 'courses';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'term_id',
        'year_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'term_id' => 'integer',
        'year_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'term_id' => 'required',
        'year_id' => 'required'
    ];

    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function enrollments(){
        return $this->belongsToMany(Enrollment::class);
    }

    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function term(){
        return $this->belongsTO(Term::class);
    }

    public function canUpdate($newStatus) {
        return $this->GetTermCourse()->status == $newStatus - 1;
    }

    public function GetTermCourse() {
        $currentTerm = Term::where('is_active', true)->first();
        if ($currentTerm->is_strict) {
            return TermCourse::where('course_id', $this->id)
                ->where('term_id', $currentTerm->id)
                ->where('academic_year', date('Y'))
                ->first();
        } else {
            return TermCourse::where('course_id', $this->id)
                ->where('academic_year', date('Y'))
                ->first();
        }
    }
}
