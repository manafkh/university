<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermCourse extends Model
{
    protected $fillable = [
        'course_id',
        'term_id',
        'academic_year',
        'status',
    ];
}

interface TermCourseStatus
{
    const INIT = 1;
    const MID_GRADES = 2;
    const FINAL = 3;
}