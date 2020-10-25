@extends('backend.layouts.master')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Product</h1>
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
                <h3> @if(isset($editData))
                  Edit Product
                  @else
                  Add Product
                @endif
                 <a class="btn btn-success float-right btn-sm" href="{{ route('products.view')}}"><i class="fa fa-list"></i> Product List</a>
                </h3>
              </div><!-- /.card-body -->
              <div class="card-body">
              	<form method="post" action="{{(@$editData)?route('products.update',$editData->id):route('products.store')}}" id="myForm" enctype="multipart/form-data">
              		@csrf
              		<div class="form-row">
                    <div class="form-group col-md-4">
                       <label>Category</label>
                       <select name="category_id" class="form-control">
                         <option value="">Select Category</option>
                         @foreach($categories as $category)
                       <option value="{{$category->id}}" {{(@$editData->category_id==$category->id)?"selected":""}}>
                        {{$category->name}}</option>
                         @endforeach
                       </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label>Brand</label>
                      <select name="brand_id" class="form-control">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{(@$editData->brand_id==$brand->id)?"selected":""}}>
                              {{$brand->name}}</option>
                        @endforeach
                      </select>
                   </div>

              			<div class="form-group col-md-4">
                      <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{@$editData->name}}" placeholder="Product Name" id="name"/>
                    <font color="red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label>Color</label>
                      <select name="color_id[]" class="form-control select2" multiple>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}" {{(@$in_array(['color_id'=>$color->id],$color_array))?"selected":""}}>{{$color->name}}</option>
                        @endforeach
                      </select>
                      <font color="red">{{($errors->has('color_id'))?($errors->first('color_id')):''}}</font> 
                   </div>

                   
                   <div class="form-group col-md-6">
                    <label>Size</label>
                    <select name="size_id[]" class="form-control select2" multiple>
                      @foreach($sizes as $size)
                          <option value="{{$size->id}}">{{$size->name}}</option>
                      @endforeach
                    </select>
                    <font color="red">{{($errors->has('size_id'))?($errors->first('size_id')):''}}</font> 
                 </div>

                 <div class="form-group col-md-12">
                  <label for="name">Short Description</label>
                  <textarea type="text" name="short_desc" class="form-control"></textarea>
                  <font color="red">{{($errors->has('short_desc'))?($errors->first('short_desc')):''}}</font> 
               </div>

               <div class="form-group col-md-12">
                <label for="name">Long Description</label>
                  <textarea type="text" name="long_desc" rows="4" class="form-control"></textarea>
                 <font color="red">{{($errors->has('long_desc'))?($errors->first('long_desc')):''}}</font> 
               </div>
               <div class="form-group col-md-3">
                <label for="price">price</label>
                <input type="text" name="price" class="form-control" placeholder="Product price" id="name"/>
              <font color="red">{{($errors->has('price'))?($errors->first('price')):''}}</font>
              </div>

          
                
              <div class="form-group col-md-3">
                <label for="image"> Image</label>
                <input type="file" name="image" class="form-control" id="image">
              </div>
              <div class="form-group col-md-2">
                <img id="showImage" src="{{(!empty($editData->image))?url('upload/product_images/'.$editData->image):url('upload/no-image.png')}}" style="width: 100px; height: 105px;border: 1px solid #000">
              </div>

                <div class="form-group col-md-3">
                  <label for="image">Sub Image</label>
                  <input type="file" name="sub_image[]" class="form-control" id="image" multiple>
                </div>
                
             
              			<div class="form-group col-md-6">
                    <button type="submit"  class="btn btn-primary">{{(@$editData)?"Update":"Submit"}}</button>
              				
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
    	
    	name: {
        required: true,
      },
    	name: {
        required: "Please enter a Name",  
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

<script type="text/javascript">
	 $(function(){
   $('.select2').select2();
	})
  </script>
@endsection