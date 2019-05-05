<?php

namespace App\Http\Controllers;

use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentReplyController extends Controller
{
    public function createReply(Request $request){
        $user = Auth::user();
        $data = [
            'comment_id' => $request->comment_id,
            'author'=> $user->name,
            'email' =>$user->email,
            'photo'=>$user->photo->file,
            'body'=>$request->body
        ];
        CommentReply::create($data);

        $request->session()->flash('reply_message','Your reply has been submitted and is waiting moderation');
        return redirect()->back();

    }
    //
}
