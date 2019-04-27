<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Student
 * @package App\Models
 * @version March 16, 2019, 3:43 pm UTC
 *
 * @property string first_name
 * @property string last_name
 * @property string father_name
 * @property string mother_name
 * @property integer phone
 * @property string email
 */
class Student extends Model
{
    use SoftDeletes;

    public $table = 'students';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'phone',
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'father_name' => 'string',
        'mother_name' => 'string',
        'phone' => 'integer',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'father_name' => 'required',
        'mother_name' => 'required',
        'phone' => 'numeric',
        'email' => 'email',
    ];

    
}
