@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lecture
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lecture, ['route' => ['lectures.update', $lecture->id], 'method' => 'patch']) !!}

                        @include('lectures.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection