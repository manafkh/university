
<!-- Id Field -->
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('id', 'Professor : ') !!}
        <p>{!! $lecture->section->professor->first_name !!}</p>
    </div>

    <!-- Subject Field -->
    <div class="form-group">
        {!! Form::label('subject', 'Subject:') !!}
        <p>{!! $lecture->subject !!}</p>
    </div>

    <!-- Section Id Field -->
    <div class="form-group">
        {!! Form::label('section_id', 'course name') !!}
        <p>{!! $lecture->section->course->title !!}</p>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        {!! Form::label('qrcode_path', 'scan QRcode and Attendance with our App:') !!}
        <p>
            <img src = "{{asset($lecture->qrcode_path)}}" width="300px">
        </p>
    </div>

    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $lecture->created_at !!}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $lecture->updated_at !!}</p>
    </div>

</div>