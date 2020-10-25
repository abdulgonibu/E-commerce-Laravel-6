<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Category;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Size;
use App\Model\Product;
use App\Model\ProductSize;
use App\Model\ProductColor;
use App\Model\ProductSubImage;
use DB;
use App\Http\Requests\BrandRequest;

class ProductController extends Controller
{
    public function view(){
        $data['alldata'] = Product::all();
        return view('backend.product.product-view', $data);
}

public function add(){
    $data['categories'] = Category::all();
    $data['brands'] = brand::all();
    $data['colors'] = color::all();
    $data['sizes'] = size::all();
  return view('backend.product.add-product', $data);
}

public function store(Request $request){
    DB::transaction(function() use ($request){
        $this->validate($request, [
            'name' => 'required|unique:products,name',
            'color_id' => 'required',
            'size_id' => 'required'
       ]);
     $product = new Product();
     $product->category_id = $request->category_id;
     $product->brand_id = $request->brand_id;
     $product->name = $request->name;
     $product->short_desc = $request->short_desc;
     $product->long_desc = $request->long_desc;
     $product->price = $request->price;
     $img = $request->file('image');
     if ($img) {
        $imgName =date('YmdHi').$img->getClientORiginalName();
        $img->move('upload/product_images/', $imgName);
        $product['image'] = $imgName;
     }
     if($product->save()){
//Product-sub-image-table-data-insert
        $files = $request->sub_image;
        if(!empty($files)){
            foreach ($files as $file){
                $imgName = date('YmdHi').$file->getClientOriginalName();
                $file->move('upload/product_images/product_sub_images', $imgName);
                $subimage['sub_image'] = $imgName;
                $subimage =new ProductSubImage();
                $subimage->product_id = $product->id;
                $subimage->sub_image = $imgName;
                $subimage->save();
            }
        }
        //Color-table-data-insert
        $colors = $request->color_id;
        if(!empty($colors)){
            foreach ($colors as $color) {
                $mycolor = new ProductColor();
                $mycolor->product_id = $product->id;
                $mycolor->color_id = $color;
                $mycolor->save();
            }
        }

//Size-table-data-insert

        $sizes = $request->size_id;
        if(!empty($sizes)){
            foreach ($sizes as $size) {
                $mysize = new ProductSize();
                $mysize->product_id = $product->id;
                $mysize->size_id = $size;
                $mysize->save();
            }
        }


     } else{
         return redirect()->back()->with('error', 'Sorry! Data not saved');
     }
    });
    return redirect()->route('products.view')->with('success', 'Data add success');
   
}

public function edit($id){
$data['editData'] = Product::find($id);
$data['categories'] = Category::all();
$data['brands'] = Brand::all();
$data['colors'] = Color::all();
$data['sizes'] = Size::all();
$data['color_array'] = ProductColor::select('color_id')->where('product_id', $data['editData']->id)->orderBy('id','asc')->get()->toArray();
$data['size_array'] = ProductSize::select('size_id')->where('product_id', $data['editData']->id)->orderBy('id','asc')->get()->toArray();

return view ('backend.product.add-product', $data);
}

public function update(BrandRequest  $request, $id){
  $data = Brand::find($id);
  $data->updated_by = Auth::user()->id;
  $data->name = $request->name;
   $data->save();
  return redirect()->route('brands.view')->with('success', 'Data update success');
}

public function delete($id){
       $brand = Brand::find($id);
       $brand->delete();
       return redirect()->route('brands.view')->with('success', 'Data deleted success');
} 
}
