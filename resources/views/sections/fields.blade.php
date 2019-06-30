<!-- Course Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Course :') !!}
    {!! Form::select('course_id',[''=>'Choose Course'] + $course , null, ['class' => 'form-control']) !!}
</div>

<!-- Professor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('professor_id', 'Professor :') !!}
    {!! Form::select('professor_id',[''=>'choose Professor']+ $professor , null, ['class' => 'form-control']) !!}
</div>

<!-- Schedule Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('schedule_id', 'Schedule :') !!}
    {!! Form::select('schedule_id',[''=>'Choose Time'] + $schedule ,  null, ['class' => 'form-control']) !!}
</div>

<!-- Room Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Room', 'Room:') !!}
    {!! Form::text('Room', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sections.index') !!}" class="btn btn-default">Cancel</a>
</div>
