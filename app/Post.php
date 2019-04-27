<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';

    protected $fillable = ['user_id','photo_id','title','body'];


}
