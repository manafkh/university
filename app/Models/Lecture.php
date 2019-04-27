<?php

namespace App\Models;

use App\ActiveLecture;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lecture
 * @package App\Models
 * @version March 19, 2019, 5:23 pm UTC
 *
 * @property string subject
 * @property integer section_id
 */
class Lecture extends Model
{
    use AsPivot;
    use SoftDeletes;

    public $table = 'lectures';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'subject',
        'section_id',
        'qrcode_path'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'subject' => 'string',
        'section_id' => 'integer',
        'qrcode_path'=> 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required',
        'section_id' => 'required'
    ];

    public function section(){

        return $this->belongsTo(Section::class);
    }

    public function activeLecture() {
        return $this->belongsTo(ActiveLecture::class);
    }
}
