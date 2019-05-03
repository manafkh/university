
@if(Auth::user()->role_id == 1)
    <li class="{{ Request::is('years*') ? 'active' : '' }}">
        <a href="{!! route('years.index') !!}"><i class="fa fa-edit"></i><span>Years</span></a>
    </li>

    <li class="{{ Request::is('terms*') ? 'active' : '' }}">
        <a href="{!! route('terms.index') !!}"><i class="fa fa-edit"></i><span>Terms</span></a>
    </li>

    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
    </li>

    <li class="{{ Request::is('employs*') ? 'active' : '' }}">
        <a href="{!! route('employs.index') !!}"><i class="fa fa-edit"></i><span>Employs</span></a>
    </li>
    <li class="{{ Request::is('scheduleTasks*') ? 'active' : '' }}">
        <a href="{!! route('scheduleTasks.index') !!}"><i class="fa fa-edit"></i><span>Schedule Tasks</span></a>
    </li>
    <li class="{{ Request::is('professors*') ? 'active' : '' }}">
        <a href="{!! route('professors.index') !!}"><i class="fa fa-edit"></i><span>Professors</span></a>
    </li>

    <li class="{{ Request::is('courses*') ? 'active' : '' }}">
        <a href="{!! route('courses.index') !!}"><i class="fa fa-edit"></i><span>Courses</span></a>
    </li>


@endif

@if(Auth::user()->role_id == 2)

<li class="{{ Request::is('lectures*') ? 'active' : '' }}">
    <a href="{!! route('lectures.index') !!}"><i class="fa fa-edit"></i><span>Lectures</span></a>
</li>

<li class="{{ Request::is('attendances*') ? 'active' : '' }}">
    <a href="{!! route('attendances.index') !!}"><i class="fa fa-edit"></i><span>Attendances</span></a>
</li>

@endif

@if(Auth::user()->role_id == 3)
    <li class="{{ Request::is('sections*') ? 'active' : '' }}">
        <a href="{!! route('weekly.year') !!}"><i class="fa fa-edit"></i><span>Sections</span></a>
    </li>

@endif


@if(Auth::user()->role_id == 4)

    <li class="{{ Request::is('schedules*') ? 'active' : '' }}">
        <a href="{!! route('schedules.index') !!}"><i class="fa fa-edit"></i><span>Schedules</span></a>
    </li>

    <li class="{{ Request::is('sections*') ? 'active' : '' }}">
        <a href="{!! route('sections.index') !!}"><i class="fa fa-edit"></i><span>Sections</span></a>
    </li>

    <li class="{{ Request::is('courseEnrollments*') ? 'active' : '' }}">
        <a href="{!! route('course_enrollments.select_course') !!}"><i class="fa fa-edit"></i><span>Course Enrollments</span></a>
    </li>

    <li class="{{ Request::is('students*') ? 'active' : '' }}">
        <a href="{!! route('students.index') !!}"><i class="fa fa-edit"></i><span>Students</span></a>
    </li>

    <li class="{{ Request::is('enrollments*') ? 'active' : '' }}">
        <a href="{!! route('enrollments.index') !!}"><i class="fa fa-edit"></i><span>Enrollments</span></a>
    </li>

@endif













