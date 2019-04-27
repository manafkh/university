<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $input = $request->all();
        $post = Post::create([

        ]);

    }

    //
}
