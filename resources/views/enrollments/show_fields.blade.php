<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $enrollment->id !!}</p>
</div>

<!-- Academicyear Field -->
<div class="form-group">
    {!! Form::label('academicYear', 'Academicyear:') !!}
    <p>{!! $enrollment->academicYear !!}</p>
</div>

<!-- Examnumber Field -->
<div class="form-group">
    {!! Form::label('ExamNumber', 'Examnumber:') !!}
    <p>{!! $enrollment->ExamNumber !!}</p>
</div>

<!-- Student Id Field -->
<div class="form-group">
    {!! Form::label('student_id', 'Student Id:') !!}
    <p>{!! $enrollment->student_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $enrollment->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $enrollment->updated_at !!}</p>
</div>

