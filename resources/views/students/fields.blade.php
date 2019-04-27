<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control','type'=>'view']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Father Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('father_name', 'Father Name:') !!}
    {!! Form::text('father_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('mother_name', 'Mother Name:') !!}
    {!! Form::text('mother_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
{{--<div class="form-group col-sm-12">--}}
    {{--{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}--}}
    {{--<a href="{!! route('students.index') !!}" class="btn btn-default">Cancel</a>--}}
{{--</div>--}}
