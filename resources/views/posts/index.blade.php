@extends('layouts.admin')



    @section('content')


            <h1 class="text-center">Posts</h1>

        <table class="table table-hover ">
            <thead>
              <tr class="post">
                  <th>ID</th>
                  <th>Photo</th>
                  <th>User</th>
                  <th>Category</th>
                  <th>Title</th>
                  <th>Body</th>
                  <th>VIEW</th>
                  <th>Created</th>
                  <th>Update</th>
              </tr>
            </thead>
            <tbody>

            @if($posts)

                @foreach($posts as $post)

              <tr>
                  <td>{{$post->id}}</td>
                  <td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400X400'}}" alt=""></td>
                  <td><a href="{{route('admin.posts.edit',$post->id)}}"> {{$post->user->name}}</a></td>
                  <td>{{$post->category ? $post->category->name : "nucategorized"}}</td>
                  <td>{{$post->title}}</td>
                  <td>{{str_limit($post->body,20)}}</td>
                  <td><a href="{{route('home.post',$post->slug)}}">View Post</a> </td>
                  <td><a href="{{route('admin.comments.show',$post->id)}}">View Comment</a> </td>
                  <td>{{$post->created_at->diffForhumans()}}</td>
                  <td>{{$post->updated_at->diffForhumans()}}</td>
              </tr>
                @endforeach
            </tbody>
        </table>

            @endif


            <div class="rows">
                <div class="col-sm-6 col-sm-offset-5">

                    {{$posts->render()}}

                </div>
            </div>




        @stop