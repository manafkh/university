<!-- Enrollment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enrollment_id', 'Enrollment Id:') !!}
    {!! Form::text('enrollment_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Course Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course Id:') !!}
    {!! Form::text('course_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Term Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('term_id', 'Term Id:') !!}
    {!! Form::text('term_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Mid Grade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mid_grade', 'Mid Grade:') !!}
    {!! Form::text('mid_grade', null, ['class' => 'form-control']) !!}
</div>

<!-- Th Grade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('th_Grade', 'Th Grade:') !!}
    {!! Form::text('th_Grade', null, ['class' => 'form-control']) !!}
</div>

<!-- Final Grade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('final_Grade', 'Final Grade:') !!}
    {!! Form::text('final_Grade', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('courseEnrollments.index') !!}" class="btn btn-default">Cancel</a>
</div>
