@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($user,['route'=>['Profile.update',$user->id],'method'=>'PATCH','files'=>true]) !!}
                    <div class="form-group col-sm-6">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('password', 'password:') !!}
                        {!! Form::password('password', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-6">
                        {!! Form::label('photo_id', 'photo:') !!}
                        {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::submit('Update User',['class'=>'btn btn-danger col-sm-6']) !!}

                    </div>

                    {{csrf_field()}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection