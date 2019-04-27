<?php

namespace App;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $fillable = ['name'];


    public function section(){
        return $this->hasOne(Section::class);
    }
    //
}
