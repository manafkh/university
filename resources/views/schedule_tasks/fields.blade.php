<!-- Start Academicyear Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_academicYear', 'Start Academicyear:') !!}
    {!! Form::date('start_academicYear', null, ['class' => 'form-control']) !!}
</div>

<!-- End Academicyear Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_academicYear', 'End Academicyear:') !!}
    {!! Form::date('end_academicYear', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Enroll Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_enroll', 'Start Enroll:') !!}
    {!! Form::date('start_enroll', null, ['class' => 'form-control']) !!}
</div>

<!-- End Enroll Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_enroll', 'End Enroll:') !!}
    {!! Form::date('end_enroll', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('scheduleTasks.index') !!}" class="btn btn-default">Cancel</a>
</div>
