@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Students</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="students-table">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{!! $student->first_name !!}</td>
                            <td>{!! $student->last_name !!}</td>
                            <td>{!! $student->father_name !!}</td>
                            <td>{!! $student->mother_name !!}</td>
                            <td>{!! $student->phone !!}</td>
                            <td>{!! $student->email !!}</td>
                            <td>

                                <div class='btn-group'>

                                    <a href="{!! route('enrollments.edit', [$student->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>

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
