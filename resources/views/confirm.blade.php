
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

<div class="content">

    <div class="box box-primary">

        <div class="box-body">
            <div class="row">
                {!! Form::open(['route' => ['confirm',$con->id],'method'=>'POST']) !!}

                <div class="form-group col-sm-6">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    {!! Form::submit('Saved', ['class' => 'btn btn-primary']) !!}

                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

</body>
</html>