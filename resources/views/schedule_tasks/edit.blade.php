@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Schedule Task
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($scheduleTask, ['route' => ['scheduleTasks.update', $scheduleTask->id], 'method' => 'patch']) !!}

                        @include('schedule_tasks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection