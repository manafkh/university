<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Next Term Field -->
<div class="form-group col-sm-6">
    {!! Form::label('next_term_id', 'Next Term:') !!}
    {!! Form::select('next_term_id', [''=>'Choose'] + $terms, null, ['class' => 'form-control']) !!}
</div>

<!-- Is strict Field -->
<div class="form-group col-sm-6">
    {!! Form::checkbox('is_strict', true, ['class' => 'form-control']) !!}
    {!! Form::label('is_strict', ' Is a strict term') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('terms.index') !!}" class="btn btn-default">Cancel</a>
</div>
