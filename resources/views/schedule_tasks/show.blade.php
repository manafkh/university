@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Schedule Task
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('schedule_tasks.show_fields')
                    <a href="{!! route('scheduleTasks.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
