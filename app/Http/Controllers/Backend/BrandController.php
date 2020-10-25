<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Brand;
use DB;
use App\Http\Requests\BrandRequest;

class BrandController extends Controller
{
    public function view(){
        $data['alldata'] = Brand::all();
        return view('backend.brand.brand-view', $data);
}

public function add(){
  return view('backend.brand.add-brand');
}

public function store(Request $request){
    $this->validate($request, [
         'name' => 'required|unique:brands,name'
    ]);
  $data = new Brand();
  $data->created_by = Auth::user()->id;
  $data->name = $request->name;

  $data->save();
  return redirect()->route('brands.view')->with('success', 'Data add success');
}

public function edit($id){
$editData = Brand::find($id);
return view ('backend.brand.edit-brand', compact('editData'));
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
