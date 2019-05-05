@extends('layouts.app')

@section('content')


<h1 class="col-lg-offset-1"> Categories </h1>

<div class="col-sm-6">

    {!! Form::open(['method'=>'POST','action'=>'PostController@createCategory']) !!}


    <div class="form-group">
        {!! Form::label('name','name: ') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}

    </div>

    <div class="form-group">
        {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}

    </div>
    {{csrf_field()}}
    {!! Form::close() !!}




</div>

<div class="col-sm-6">

    @if($category)

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>created</th>

            </tr>
            </thead>
            <tbody>
            @foreach($category as $categories)
                <tr>
                    <td>{{$categories->id}}</td>
                    <td>{{$categories->name}}</td>
                    <td>{{$categories->created_at ? $categories->created_at->diffForHumans() : "hi"}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif






</div>

    @endsection