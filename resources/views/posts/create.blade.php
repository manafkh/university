@extends('layouts.app')



@section('content')

 <section class="content-header">
     <h1>
         Student
     </h1>
 </section>
 <div class="content">
     @include('adminlte-templates::common.errors')
     <div class="box box-primary">

         <div class="box-body">
             <div class="row">
                 {!! Form::open([ 'route'=>'posts.store','files'=>true]) !!}


                 <div class="form-group col-sm-6">
                     {!! Form::label('title','Title: ') !!}
                     {!! Form::text('title',null,['class'=>'form-control']) !!}

                 </div>
                 <div class="form-group col-sm-6">
                     {!! Form::label('category_id','category: ') !!}
                     {!! Form::select('category_id',[''=>'Choose Categories'] + $categories,null,['class'=>'form-control']) !!}

                 </div>

                 <div class="form-group col-sm-6">
                     {!! Form::label('photo_id','photo: ') !!}
                     {!! Form::file('photo_id',null,['class'=>'form-control','btn btn-danger']) !!}
                 </div>

                 <div class="form-group col-sm-6">
                     {!! Form::label('body','Body : ') !!}
                     {!! Form::textarea('body',null,['class'=>'form-control','rows'=>2]) !!}
                 </div>


                 <div class="form-group col-sm-6">
                     {!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}

                 </div>
                 {{csrf_field()}}
                 {!! Form::close() !!}
             </div>
         </div>
     </div>
 </div>

@stop