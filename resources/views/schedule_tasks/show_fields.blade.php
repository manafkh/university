<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $scheduleTask->id !!}</p>
</div>

<!-- Start Academicyear Field -->
<div class="form-group">
    {!! Form::label('start_academicYear', 'Start Academicyear:') !!}
    <p>{!! $scheduleTask->start_academicYear !!}</p>
</div>

<!-- End Academicyear Field -->
<div class="form-group">
    {!! Form::label('end_academicYear', 'End Academicyear:') !!}
    <p>{!! $scheduleTask->end_academicYear !!}</p>
</div>

<!-- Start Enroll Field -->
<div class="form-group">
    {!! Form::label('start_enroll', 'Start Enroll:') !!}
    <p>{!! $scheduleTask->start_enroll !!}</p>
</div>

<!-- End Enroll Field -->
<div class="form-group">
    {!! Form::label('end_enroll', 'End Enroll:') !!}
    <p>{!! $scheduleTask->end_enroll !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $scheduleTask->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $scheduleTask->updated_at !!}</p>
</div>

