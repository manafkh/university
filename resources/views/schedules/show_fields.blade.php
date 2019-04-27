<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $schedule->id !!}</p>
</div>

<!-- Day Field -->
<div class="form-group">
    {!! Form::label('day', 'Day:') !!}
    <p>{!! $schedule->day !!}</p>
</div>

<!-- Start Time Field -->
<div class="form-group">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{!! $schedule->start_time !!}</p>
</div>

<!-- End Time Field -->
<div class="form-group">
    {!! Form::label('end_time', 'End Time:') !!}
    <p>{!! $schedule->end_time !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $schedule->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $schedule->updated_at !!}</p>
</div>

