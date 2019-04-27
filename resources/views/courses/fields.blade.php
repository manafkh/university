<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Term Field -->
<div class="form-group col-sm-6">
    {!! Form::label('term_id', 'Term:') !!}
    {!! Form::select('term_id',[''=>'Choose term'] + $term , null, ['class' => 'form-control']) !!}
</div>

<!-- Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('year_id', 'Year:') !!}
    {!! Form::select('year_id',[''=>'Choose year'] + $year , null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('courses.index') !!}" class="btn btn-default">Cancel</a>
</div>
