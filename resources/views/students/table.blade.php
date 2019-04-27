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
                {{--{!! Form::open(['route' => ['students.destroy', $student->id], 'method' => 'delete']) !!}--}}
                <div class='btn-group'>
                    {{--<a href="{!! route('students.show', [$student->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                    <a href="{!! route('students.edit', [$student->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {{--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                </div>
                {{--{!! Form::close() !!}--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>