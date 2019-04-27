<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $attendance->id !!}</p>
</div>

<!-- Student Id Field -->
<div class="form-group">
    {!! Form::label('student_id', 'Student Id:') !!}
    <p>{!! $attendance->student_id !!}</p>
</div>

<!-- Lecture Id Field -->
<div class="form-group">
    {!! Form::label('lecture_id', 'Lecture Id:') !!}
    <p>{!! $attendance->lecture_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $attendance->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $attendance->updated_at !!}</p>
</div>

