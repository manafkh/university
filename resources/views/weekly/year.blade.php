@extends('layouts.app')

@section('content')
    <table class="table table-responsive" id="years-table">
        <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($years as $year)
            @foreach($terms as $term)
                <tr>
                    <td>{{ $year->name }}, {{ $term->name }}</td>
                    <td>
                        <div class='btn-group'>
                            <a href="{!! route('weekly.FirstYear', ['year_id' => $year->id, 'term_id' => $term->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
@endsection
