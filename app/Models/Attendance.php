<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Attendance
 * @package App\Models
 * @version March 20, 2019, 10:32 am UTC
 *
 * @property integer student_id
 * @property integer lecture_id
 */
class Attendance extends Model
{
    use SoftDeletes;

    public $table = 'attendances';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'enrollment_id',
        'lecture_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'enrollment_id' => 'integer',
        'lecture_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
