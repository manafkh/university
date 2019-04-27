@extends('layouts.app')

@section('content')
@foreach($enrollments as $enrollment)

    {!! $enrollment->year_id !!}}



    @endforeach


@endsection