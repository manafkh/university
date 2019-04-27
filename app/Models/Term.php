<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Term
 * @package App\Models
 * @version March 25, 2019, 7:11 pm UTC
 *
 * @property string name
 */
class Term extends Model
{
    use SoftDeletes;

    public $table = 'terms';
    

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

    public function course(){
        return $this->hasOne(Course::class);
    }


    
}
