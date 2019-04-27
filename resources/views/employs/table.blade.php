<table class="table table-responsive" id="employs-table">
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
    @foreach($employs as $employ)
        <tr>
            <td>{!! $employ->first_name !!}</td>
            <td>{!! $employ->last_name !!}</td>
            <td>{!! $employ->phone !!}</td>
            <td>{!! $employ->email !!}</td>
            <td>
                {!! Form::open(['route' => ['employs.destroy', $employ->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('employs.show', [$employ->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('employs.edit', [$employ->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>