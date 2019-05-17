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
            <td>{!! $course->term->name !!}</td>
            <td>{!! $course->year->name !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('course_enrollments.exam', [$course->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('course_enrollments.export', [$course->id]) !!}" class='btn btn-success btn-xs'><i class="glyphicon glyphicon-eye-open"></i>export</a>




                    <form action="{{ route('course_enrollments.import', [$course->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">Import User Data</button>
                    </form>
                    {{--{!! Form::open(['method'=>'POST','action'=>'CourseEnrollmentController@import','file'=>true]) !!}--}}

                        {{--{!! Form::label('file','File: ') !!}--}}
                        {{--{!! Form::file('file',null,['class'=>'form-control','btn btn-danger']) !!}--}}
                    {{--{!! Form::submit('import',['class'=>'btn btn-primary']) !!}--}}
                    {{--{{csrf_field()}}--}}
                    {{--{!! Form::close() !!}--}}

                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>