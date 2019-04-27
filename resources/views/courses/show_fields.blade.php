<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $course->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $course->title !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $course->description !!}</p>
</div>

<!-- Term Field -->
<div class="form-group">
    {!! Form::label('term', 'Term:') !!}
    <p>{!! $course->term !!}</p>
</div>

<!-- Year Field -->
<div class="form-group">
    {!! Form::label('Year', 'Year:') !!}
    <p>{!! $course->Year !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $course->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $course->updated_at !!}</p>
</div>

