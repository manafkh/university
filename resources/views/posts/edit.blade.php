@extends('layouts.app')



@section('content')


    <h1 class="text-center">Edit Posts</h1>

    <div class="row">
        {!! Form::model($post,['method'=>'PATCH','action'=>['PostController@update',$post->id],'files'=>true]) !!}


        <div class="form-group col-sm-6">
            {!! Form::label('title','Title: ') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}

        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('photo_id','photo: ') !!}
            {!! Form::file('photo_id',null,['class'=>'form-control','btn btn-danger']) !!}
        </div>

        <div class="form-group col-sm-6">
            {!! Form::label('body','Name : ') !!}
            {!! Form::textarea('body',null,['class'=>'form-control','row'=>2]) !!}
        </div>


        <div class="form-group col-sm-6">
            {!! Form::submit('Update Post',['class'=>'btn btn-primary col-sm-6']) !!}

        </div>


        {{csrf_field()}}

        {!! Form::close() !!}



        {!! Form::open(['method'=>'DELETE','action'=>['PostController@destroy',$post->id],'files'=>true]) !!}


        <div class="form-group col-sm-6">
            {!! Form::submit('DELETE Post',['class'=>'btn btn-danger col-sm-6']) !!}

        </div>
        {{csrf_field()}}

        {!! Form::close() !!}

    </div>

    <div class="row">


    </div>





@endsection