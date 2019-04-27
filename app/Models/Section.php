<?php

namespace App\Models;

use App\Room;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Section
 * @package App\Models
 * @version March 18, 2019, 4:23 pm UTC
 *
 * @property integer course_id
 * @property integer professor_id
 * @property integer schedule_id
 * @property string Room
 */
class Section extends Pivot
{
    use SoftDeletes;

    public $table = 'sections';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'course_id',
        'professor_id',
        'schedule_id',
        'Room'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'course_id' => 'integer',
        'professor_id' => 'integer',
        'schedule_id' => 'integer',
        'Room' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_id' => 'required',
        'professor_id' => 'required',
        'schedule_id' => 'required',
        'Room' => 'required'
    ];

    public function course(){

        return $this->belongsTo(Course::class);
    }

    public function professor(){

        return $this->belongsTo(Professor::class);
    }

    public function schedule(){

        return $this->belongsTo(Schedule::class);
    }
    public function room(){
        return $this->belongsTo(Room::class);
    }

    
}
