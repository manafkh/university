<table class="table table-responsive" id="sections-table">
    <thead>
        <tr>
            <th>Course </th>
        <th>Professor </th>
        <th>Schedule </th>
        <th>Room</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sections as $section)
        <tr>
            <td>{!! $section->course->title !!}</td>
            <td>{!! $section->professor->first_name .' '. $section->professor->last_name !!}</td>
            <td>{!! $section->schedule->start_time .' '. $section->schedule->end_time !!}</td>
            <td>{!! $section->Room !!}</td>
            <td>
                {!! Form::open(['route' => ['sections.destroy', $section->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sections.show', [$section->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sections.edit', [$section->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>