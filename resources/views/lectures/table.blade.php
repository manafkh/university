<table class="table table-responsive" id="lectures-table">
    <thead>
        <tr>
            <th>Course Name</th>
        <th>Time </th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($lectures as $lecture)
        <tr>
            <td>{!! $lecture->title !!}</td>
            <td>{!! $lecture->full_time !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('lectures.selectLecturesCourse', [$lecture->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>