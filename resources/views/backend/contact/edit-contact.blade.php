@extends('backend.layouts.master')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Contact</h1>
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
                <h3> Edit Service
                 <a class="btn btn-success float-right btn-sm" href="{{ route('contacts.add')}}"><i class="fa fa-list"></i> Add Contact</a>
                </h3>
              </div><!-- /.card-body -->
              <div class="card-body">
              	<form method="post" action="{{ route('contacts.update', $editData->id)}}" id="myForm" enctype="multipart/form-data">
              		@csrf
              		<div class="form-row">
              			<div class="form-group col-md-4">
                      <label for="address"> Address</label>
                      <input type="text" name="address" value="{{ $editData->address}}" class="form-control" id="address">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="mobile"> Mobile</label>
                      
                      <input type="text" name="mobile" value="{{ $editData->mobile}}" class="form-control" id="mobile">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email"> Email</label>
                      <input type="email" name="email" value="{{ $editData->email}}" class="form-control" id="email">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="facebook"> facebook</label>
                      <input type="text" name="facebook" value="{{ $editData->facebook}}" class="form-control" id="facebook">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="twtter"> Twitter</label>
                      <input type="text" name="twtter" value="{{ $editData->twtter}}" class="form-control" id="twtter">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="youtube"> Youtube</label>
                      <input type="text" name="youtube" value="{{ $editData->youtube}}" class="form-control" id="youtube">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="google_plus"> Youtube</label>
                      <input type="text" name="google_plus" value="{{ $editData->google_plus}}" class="form-control" id="google_plus">
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


@endsection