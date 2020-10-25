@extends('backend.layouts.master')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <section class="col-sm-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>User Passwrod Change
                 <a class="btn btn-success float-right btn-sm" href="{{ route('profile.view')}}"><i class="fa fa-list"></i>Your Profile</a>
                </h3>
              </div><!-- /.card-body -->
              <div class="card-body">
              	<form method="post" action="{{ route('password.update.view')}}" id="myForm">
              		@csrf
              		<div class="form-row">
              			<div class="form-group col-md-4">
              				<label for="current_password">Current Password</label>
              				<input type="password" name="current_password" id="current_password" class="form-control">
              			</div>
              			
              			<div class="form-group col-md-4">
              				<label for="new_password">New Password</label>
              				<input type="password" name="new_password" id="new_password" class="form-control">
              			</div>
              			<div class="form-group col-md-4">
              				<label for="confirm_password">Confirm Password</label>
              				<input type="password" name="confirm_password" class="form-control">
              			</div>
              			<div class="form-group col-md-6">
              				<input type="submit" value="Update" class="btn btn-primary">
              			</div>

              		</div>

              	</form>

              </div>
            </div>
           
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
               </div>
            </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

</div>

 <script type="text/javascript">
$(document).ready(function () {
  $('#myForm').validate({
    rules: {
    	 usertype: {
        required: true,
      },
    	name: {
        required: true,
      },

    
      email: {
        required: true,
        email: true,
      },

      password: {
        required: true,
        minlength: 5
      },
      password2: {
        required: true,
        equalTo: '#password'
    },

    messages: {

    	 usertype: {
        required: "Please Select a Roll",
        
      },

    	name: {
        required: "Please enter a Name",
        
      },
     
      email: {
        required: "Please enter a email address",
        
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
     password2: {
        required: "Please provide a Confirm password",
        equalTo: "Your password must be at least 5 characters long"
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