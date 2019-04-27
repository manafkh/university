<!-- Academicyear Field -->
<div class="form-group col-sm-6">
    {!! Form::label('year_id', 'AcademicYear:') !!}
    {!! Form::select('year_id',[''=> 'Choose Year'] + $year , null, ['class' => 'form-control']) !!}
</div>

<!-- Examnumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ExamNumber', 'Exam Number:') !!}
    {!! Form::text('ExamNumber', null, ['class' => 'form-control']) !!}
</div>

{{--<!-- Student Id Field -->--}}
{{--<div class="form-group col-sm-6">--}}
    {{--{!! Form::label('enroll_year', 'enroll_year') !!}--}}
    {{--{!! Form::text('enroll_year',null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('enrollments.index') !!}" class="btn btn-default">Cancel</a>
</div>
