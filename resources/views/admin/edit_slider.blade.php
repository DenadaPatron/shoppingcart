@extends('admin_layout.admin')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Edit slider</h3>
              @if (Session::has('status'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>  
                    {{Session::get('status')}}
                  </div>  
              @endif
            {{-- Dislay if category not unique & give error   --}}
            @if(count($errors) > 0)
              <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                  <strong>Dang!</strong> There were some problems with your input:<br>
                  <ul>
                      @foreach ($errors->all() as $error)
                      </li>{{$error}}</li>
                      <br>
                      @endforeach
                </ul>
              </div>  
            @endif
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!!Form::open(['action' => 'App\Http\Controllers\SliderController@editslider',
            'method'  =>  'POST','enctype' => 'multipart/form-data'])!!}
            {{csrf_field()}}
            <div class="card-body">
                  <div class="form-group">
                    {{Form::label('', 'Description One', ['for' => 'exampleInputEmail1'] )}}
                    {{ Form::text('description1', '', ['class' => 'form-control', 'placeholder' => 'Enter description 1']) }}
                    {{-- <label for="exampleInputEmail1">Product name</label>
                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name"> --}}
                  </div>
                  <div class="form-group">
                    {{Form::label('', 'Description Two', ['for' => 'exampleInputEmail1'] )}}
                    {{ Form::text('description2', '', ['class' => 'form-control', 'placeholder' => 'Enter description 2']) }}
                    {{-- <label for="exampleInputEmail1">Product name</label>
                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name"> --}}
                  </div>

              <label for="exampleInputFile">Slider image</label>
              <div class="input-group">
                <div class="custom-file">
                  {{Form::file('slider_image', ['class' => 'custom-file-input', 'id' => 'exampleInputFile'])}}
                  {{Form::label('', 'Choose file', ['class' => 'custom-file-label'])}}
                  {{-- <input type="file" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label> --}}
                </div>

                
                <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              {{Form::submit('Save', ['class' => 'btn btn-success'])}}
            </div>
            {!!Form::close()!!}
          </div>
          <!-- /.card --> 
          </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
</html>
@endsection


@section('scripts')

<!-- jquery-validation -->
<script src="backend/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="backend/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="backend/dist/js/adminlte.min.js"></script>
<script src="backend/plugins/jquery/jquery.min.js"></script>

<script>
    $(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#quickForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 5
          },
          terms: {
            required: true
          },
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>

    @endsection