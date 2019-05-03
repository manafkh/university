<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['post_id','author','body','email'];

    public function post() {
        return $this->belongsTo(Post::class);
    }
    public function replies(){
        return $this->hasMany(CommentReply::class);
    }

}
