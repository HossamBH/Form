<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>

    <meta charset="utf-8" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Content</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('dist/css/bootstrap.min.css')}}" rel="stylesheet">


</head>
<body>

    <div class="container">
        <div class="py-5 text-center">
            <h2>Form</h2>
        </div>
        @inject('model','App\Content')
        <div class="box-body">

          @include('errors')
          @include('flash::message')

          {!! Form::model($model,[
            'action' => 'Web\ContentController@store',
            'files' => true
          ]) !!}
            
          @include('content.form')
           
          {!! Form::close() !!}
        <!-- /.box-body -->
      </div>

    </div>

</body>
</html>
