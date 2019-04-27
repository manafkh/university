<table class="table table-responsive" id="years-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($years as $year)
        <tr>
            <td>{!! $year->name !!}</td>
            <td>
                {!! Form::open(['route' => ['years.destroy', $year->id], 'method' => 'delete']) !!}
                <div class='btn-group'>

                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>