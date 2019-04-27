<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedule
 * @package App\Models
 * @version March 18, 2019, 4:18 pm UTC
 *
 * @property string day
 * @property time start_time
 * @property time end_time
 */
class Schedule extends Pivot
{
    use SoftDeletes;

    public $table = 'schedules';

    public static $day = [
        'Su'=>'الاحد',
        'Mo'=> 'الاثنين',
        'Tu'=> 'الثلاثاء',
        'We'=> 'الاربعاء',
        'TH'=>'الخميس'

    ];
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'day',
        'start_time',
        'end_time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'day' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'day' => 'required',
        'start_time' => 'required',
        'end_time' => 'required'
    ];


    public function sections(){

        return $this->hasMany(Section::class);
    }
    
}
