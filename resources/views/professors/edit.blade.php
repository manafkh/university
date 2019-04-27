@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Professor
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($professor, ['route' => ['professors.update', $professor->id], 'method' => 'patch']) !!}

                        @include('professors.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection