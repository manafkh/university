<?php

namespace App;

use App\Models\Lecture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ActiveLecture extends Model
{
    protected $table = 'active_lectures';

    public $timestamps = false;

    protected $fillable = [
        'next_scan_id',
        'lecture_id',
    ];

    public function Lecture() {
        return $this->hasOne(Lecture::class);
    }
}
