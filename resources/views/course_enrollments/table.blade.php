<table class="table table-responsive" id="courseEnrollments-table">
    <thead>
        <tr>
            <th>Enrollment Id</th>
        <th>Course Id</th>
            <th>Term Id</th>
        <th>Mid Grade</th>
        <th>Th Grade</th>
        <th>Final Grade</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($courseEnrollments as $courseEnrollment)
        <tr>
            <td>{!! $courseEnrollment->enrollment->ExamNumber !!}</td>
            <td>{!! $courseEnrollment->course->title !!}</td>
            <td>{!! $courseEnrollment->course->term_id !!}</td>
            <td>{!! $courseEnrollment->mid_grade !!}</td>
            <td>{!! $courseEnrollment->th_Grade !!}</td>
            <td>{!! $courseEnrollment->final_Grade !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>