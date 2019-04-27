<table class="table table-responsive" id="courseEnrollments-table">
    <thead>
    <tr>
        <th> Exam Number</th>
        <th>First_name </th>
        <th>Last_name </th>
        <th>Father name</th>
        <th>Mid Grade</th>


    </tr>
    </thead>
    <tbody>
    @foreach($courseEnrollments as $courseEnrollment)
        <tr>
            <td>{!! $courseEnrollment->ExamNumber !!}</td>
            <td>{!! $courseEnrollment->first_name !!}</td>
            <td>{!! $courseEnrollment->last_name !!}</td>
            <td>{!! $courseEnrollment->father_name !!}</td>
            <td>{!! $courseEnrollment->mid_grade !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>