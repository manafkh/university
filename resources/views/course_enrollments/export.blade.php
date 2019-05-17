<table class="table table-responsive" id="courseEnrollments-table">
    <thead>
    <tr>
        <th> Exam Number</th>
        <th>First_name </th>
        <th>Last_name </th>
        <th>Father name </th>
        @switch($status)
            @case(\App\Enums\TermCourseStatus::INIT)
            <th>Mid Grade </th>
            @break
            @case(\App\Enums\TermCourseStatus::MID_GRADES)
            <th>Th Grade </th>
            @break
            @case(\App\Enums\TermCourseStatus::FINAL)
            <th>Mid Grade </th>
            <th>Th Grade </th>
            <th>Final Grade </th>
            @break
        @endswitch
    </tr>
    </thead>
    <tbody>
    @foreach($courseEnrollments as $courseEnrollment)
        <tr>
            <td>{!! $courseEnrollment->ExamNumber !!}</td>
            <td>{!! $courseEnrollment->first_name !!}</td>
            <td>{!! $courseEnrollment->last_name !!}</td>
            <td>{!! $courseEnrollment->father_name !!}</td>
            @switch($status)
                @case(\App\Enums\TermCourseStatus::INIT)
                <td>{!! $courseEnrollment->mid_grade !!}</td>
                @break
                @case(\App\Enums\TermCourseStatus::MID_GRADES)
                <td>{!! $courseEnrollment->th_Grade !!}</td>
                @break
                @case(\App\Enums\TermCourseStatus::FINAL)
                <td>{!! $courseEnrollment->mid_grade !!}</td>
                <td>{!! $courseEnrollment->th_Grade !!}</td>
                <td>{!! $courseEnrollment->final_Grade !!}</td>
                @break
            @endswitch
        </tr>
    @endforeach
    </tbody>
</table>