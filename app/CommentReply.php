<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $table = 'comment_replies';

    protected $fillable = ['comment_id','photo','author','body','email'];
    //

    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
