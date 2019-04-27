<table class="table table-responsive" id="professors-table">
    <thead>
        <tr>
            <th>First Name</th>
        <th>Last Name</th>
        <th>Phone</th>
        <th>Email</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($professors as $professor)
        <tr>
            <td>{!! $professor->first_name !!}</td>
            <td>{!! $professor->last_name !!}</td>
            <td>{!! $professor->phone !!}</td>
            <td>{!! $professor->email !!}</td>
            <td>
                {!! Form::open(['route' => ['professors.destroy', $professor->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('professors.show', [$professor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('professors.edit', [$professor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>