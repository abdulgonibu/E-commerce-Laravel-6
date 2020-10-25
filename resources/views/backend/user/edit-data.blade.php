@extends('backend.layouts.master')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
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
                <h3> Edit User
                 <a class="btn btn-success float-right btn-sm" href="{{ route('users.update', $editData->id)}}"><i class="fa fa-list"></i>User List</a>
                </h3>
              </div><!-- /.card-body -->
              <div class="card-body">
              	<form method="post" action="{{ route('users.update', $editData->id)}}" id="myForm">
              		@csrf
              		<div class="form-row">
              			<div class="form-group col-md-4">
              				<label for="usertype">User Role</label>
              				<select name="usertype" id="usertype" class="form-control">
              					<option value="">Select Roll</option>
              					<option value="admin" {{($editData-> usertype=="Admin")?"selected":""}}>Admin</option>
              					<option value="user" {{($editData-> usertype=="User")?"selected":""}}>User</option>
              				</select>
              			</div>
              			<div class="form-group col-md-4">
              				<label for="usertype">Name</label>
              				<input type="text" name="name" value="{{ $editData->name}}" class="form-control">
              				<font style="color: red">
              					{{($errors->has('name'))?($errors->first('name')):''}}
              				</font>
              			</div>
              			<div class="form-group col-md-4">
              				<label for="usertype">Email</label>
              				<input type="eamil" name="email" value="{{ $editData->email}}" class="form-control">
              				<font style="color: red">
              					{{($errors->has('email'))?($errors->first('email')):''}}
              				</font>
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