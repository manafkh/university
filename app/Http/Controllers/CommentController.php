<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentNotification;
use App\Notifications\PostNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = [
            'post_id' => $request->post_id,
            'author'=> $user->name,
            'email' =>$user->email,
            'photo'=>$user->photo->file,
            'body'=>$request->body
        ];
        Comment::create($data);
        $request->session()->flash('comment_message','Your message has been submitted and is waiting moderation');


        $users = User::where('id','!=',auth()->user()->id)->get();
        if (\Notification::send($users,new CommentNotification(Comment::latest('id')->first()))){
            return back();
        }
        return redirect()->back();
    }

}
