<table class="table table-responsive" id="scheduleTasks-table">
    <thead>
        <tr>
            <th>Start Academicyear</th>
        <th>End Academicyear</th>
        <th>Start Enroll</th>
        <th>End Enroll</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($scheduleTasks as $scheduleTask)
        <tr>
            <td>{!! $scheduleTask->start_academicYear !!}</td>
            <td>{!! $scheduleTask->end_academicYear !!}</td>
            <td>{!! $scheduleTask->start_enroll !!}</td>
            <td>{!! $scheduleTask->end_enroll !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('scheduleTasks.edit', [$scheduleTask->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>