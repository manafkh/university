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