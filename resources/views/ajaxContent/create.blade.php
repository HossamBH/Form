@extends('layouts.app')
@inject('model','App\Content')
@inject('gender','App\Gender')
@section('content')

    <div class="container">
        <div class="py-5 text-center">
            <h2>Form</h2>
        </div>
        
        <div class="box-body">

          @include('errors')
          @include('flash::message')

          {!! Form::model($model,[
            'action' => 'AjaxController@store',
            'files' => true
          ]) !!}
            
          @include('ajaxContent.createForm')
           
          {!! Form::close() !!}
        <!-- /.box-body -->
      </div>

    </div>
    @push('scripts')
        <script>
            $(document).on('click','#save', function(e){
                e.preventDefault();         
                $.ajax({
                      type:"post",
                      url: "{{route('ajax.store')}}",
                      data: {
                          '_token' : "{{csrf_token()}}",
                          'name' $("input[name='name']").val(),
                          'age' $("input[name='age']").val(),
                          'image' $("input[name='imahe']").val(),
                          'gender_id' $("input[name='gender_id']").val(),

                      },
                      success: function (data){
                      },
                      error: function (reject){

                      }
                });
            });    
        </script>

    @endpush
@endsection