<table class="table table-responsive" id="courses-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Term</th>
        <th>Year</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
        <tr>
            <td>{!! $course->title !!}</td>
            <td>{!! $course->term_id !!}</td>
            <td>{!! $course->year_id !!}</td>
            <td>
                {!! Form::open(['route' => ['courses.destroy', $course->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('courses.show', [$course->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('lectures.selectLecturesCourse', [$course->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>