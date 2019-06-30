<?php

namespace App\Http\Controllers;

use App\Jobs\GiveExamNumber;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Profile')->with('user',$user);

    }
    public function update(Request $request ,$id)
    {
        $user = User::findOrFail($id);
        if (trim($request->password )=='') {
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = Hash::make($request->password);
        }
        if ($file = $request->file('photo_id'))
        {
            $name = time() . $file->getClientOriginalName();
            $file->move('image',$name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return view('/home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       GiveExamNumber::dispatch()->delay(now()->addMinutes(1));
        return view('home');
    }
}
