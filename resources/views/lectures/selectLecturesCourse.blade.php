
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Lectures </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('lectures.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="lectures-table">
                    <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Lecture Id</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lectures as $lecture)
                        <tr>
                            <td>{!! $lecture->subject !!}</td>
                            <td>{!! $lecture->id !!}</td>
                            <td>
                                <div class='btn-group'>
                                    <a href="{!! route('attendances.showAttendance', [$lecture->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
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






