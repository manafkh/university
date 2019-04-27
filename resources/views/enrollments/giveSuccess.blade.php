@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Enrollments</h1>

    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="enrollments-table">
                    <thead>
                    <tr>
                        <th>Academicyear</th>
                        <th>Examnumber</th>
                        <th>Student Id</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{!! $enrollment->year_id !!}</td>
                            <td>{!! $enrollment->ExamNumber !!}</td>
                            <td>{!! $enrollment->student_id !!}</td>
                            <td>
                                <div class='btn-group'>
                                    <a href="{!! route('enrollments.show', [$enrollment->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                                </div>

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



