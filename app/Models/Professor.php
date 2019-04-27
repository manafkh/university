<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Professor
 * @package App\Models
 * @version March 16, 2019, 7:39 pm UTC
 *
 * @property string first_name
 * @property string last_name
 * @property integer phone
 * @property string email
 */
class Professor extends Model
{
    use SoftDeletes;

    public $table = 'professors';
    

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
        'phone' => 'numeric|required|unique:employs',
        'email' => 'email|required|unique:employs'
    ];


    public function sections(){

        return $this->hasMany(Section::class);
    }
    
}
