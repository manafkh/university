<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Section Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('section_id', 'Section :') !!}
    {!! Form::select('section_id',[''=>'Choose course'] + $select , null, ['class' => 'form-control']) !!}
</div>
{{--<!-- Qrcode Path Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('qrcode_path', 'Qrcode Path:') !!}--}}
    {{--{!! Form::text('qrcode_path', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('lectures.index') !!}" class="btn btn-default">Cancel</a>
</div>
