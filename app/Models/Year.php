<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Year
 * @package App\Models
 * @version March 25, 2019, 7:09 pm UTC
 *
 * @property string name
 */
class Year extends Model
{
    use SoftDeletes;

    public $table = 'years';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * @return mixed
     */
    public function course(){
        return $this->hasOne(Course::class);
    }
    public function enrollment(){
        return $this->hasOne(Enrollment::class);
    }

    
}
