<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employ
 * @package App\Models
 * @version April 13, 2019, 2:02 pm UTC
 *
 * @property string first_name
 * @property string last_name
 * @property integer phone
 * @property string email
 */
class Employ extends Model
{
    use SoftDeletes;

    public $table = 'employs';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'first_name',
        'last_name',
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
        'phone' => 'required|number|unique:employs|max:10|min:10',
        'email' => 'required|unique:employs|email'
    ];

    
}
