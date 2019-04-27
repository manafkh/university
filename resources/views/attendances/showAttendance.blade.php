@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Attendances</h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="attendances-table">
                    <thead>
                    <tr>
                        <th>Exam Number</th>
                        <th>Student Name</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{!! $attendance->ExamNumber !!}</td>
                            <td>{!! $attendance->full_name!!}</td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection