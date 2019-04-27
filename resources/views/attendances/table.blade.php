<table class="table table-responsive" id="attendances-table">
    <thead>
        <tr>
            <th>Student Id</th>
        <th>Lecture Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($attendances as $attendance)
        <tr>
            <td>{!! $attendance->enrollment_id !!}</td>
            <td>{!! $attendance->lecture_id !!}</td>

        </tr>
    @endforeach
    </tbody>
</table>