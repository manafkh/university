<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(4);
        return view('interface.blog')->with('posts',$posts);
    }

    public function create()
    {
        $categories =Category::pluck('name','id')->all();
        return view('posts.create')->with('categories',$categories);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $user = Auth::user();

        if ($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('image',$name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        $user->post()->create($input);

        return redirect('interface/blog');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('interface/blog-single')->with('post',$post);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input =   $request->all();

        if ($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('image',$name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        Auth::user()->post()->whereId($id)->first()->update($input);

        return redirect('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . $post->photo->file);
        $post->delete();
        return redirect('admin/posts');
    }

    public function post($id){

        $post = Post::find($id);
        $posts = Post::all();
        $categories = Category::all();
        $comments = $post->comments()->get();

        return view('interface/blog-single')
            ->with('posts',$posts)
            ->with('post',$post)
            ->with('comments',$comments)
            ->with('categories',$categories);


    }
    public function createCategory(Request $request){
        $input = $request->all();
        Category::create($input);
        return redirect('posts/categories');
    }
    public function categories()
    {
        $category = Category::all();
        return view('posts/categories')->with('category',$category);
    }
    public function postsCategory($id){

        $category = Category::find($id);
        $posts = Post::where('category_id',$category->id)->get();
        return view('interface/blog-category')
            ->with('posts',$posts);
    }
}
