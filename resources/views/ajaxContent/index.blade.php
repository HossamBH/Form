@extends('layouts.app')
@inject(genders,App\Gender)
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Content
        <small>list</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div>

                    {!! Form::open([

                    'method' => 'get'

                    ]) !!}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('name',request()->input('name'),[

                                'placeholder' => 'Name',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                {!! Form::select('gender_id',$genders->pluck('name','id')->toArray(),request()->input('gender_id'),[

                                'class' => 'select2 form-control',

                                'placeholder' => 'Gender'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i></button>

                            </div>

                        </div>

                    </div>

                    {!! Form::close() !!}

        </div>
        
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Show Content</h3>
        </div>
        <div class="box-body">
          @include('flash::message')
          @if(count($content))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Image</th>
                  <th>Gender</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($content as $row)
                    <tr id="tr{{$row->id}}">
                      <td>{{$loop->iteration}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->age}}</td>
                      <td>
                        <img src="{{$row->image}}" class="img-rounded" width="75px">
                      </td>
                      <td>{{$row->gender->name}}</td>
                      <td>
                          <a href="{{url(route('content.edit', $row->id))}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i>Edit</a></td>
                      <td>
                          <a href="{{url(route('content.remove', $row->id))}}" class="btn btn-danger btn-xs" data-id="{{ $row->id }}" data-value="{{ $row->id }}"><i class="fa fa-trash-o"></i></a></td> 
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="alert alert-danger" role="alert">
              No data
            </div>
          @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

    @push('scripts')
        <script>
          $(document).ready(function(){
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });


              $(".btn btn-danger").click(function(e){
                  if(!confirm("Do you really want to do this?")) {
                      return false;
                  }
                  e.preventDefault();
                  var id = $(this).data('id');
                  var url = $(this).attr('href');
                  $.ajax(
                      {
                          url: url,
                          method:"post",
                          dataType:'json',
                          processData: false,
                          contentType: false,
                          success: function (data){
                              console.log(data.record);
                              $("#tr"+id).remove();
                              Swal.fire(
                                  'Remind!',
                                  'Data deleted successfully!',
                                  'success'
                              );

                          }
                      });
                  return false;
              });
          });
        </script>

    @endpush

@endsection
