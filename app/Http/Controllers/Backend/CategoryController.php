<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Category;
use DB;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function view(){
        $data['alldata'] = Category::all();
        return view('backend.category.category-view', $data);
}

public function add(){
  return view('backend.category.add-category');
}

public function store(Request $request){
    $this->validate($request, [
         'name' => 'required|unique:categories,name'
    ]);
  $data = new Category();
  $data->created_by = Auth::user()->id;
  $data->name = $request->name;

  $data->save();
  return redirect()->route('categories.view')->with('success', 'Data add success');
}



public function edit($id){
$editData = Category::find($id);
return view ('backend.category.edit-category', compact('editData'));
}

public function update(CategoryRequest  $request, $id){
  $data = Category::find($id);
  $data->updated_by = Auth::user()->id;
  $data->name = $request->name;
  

   $data->save();
  return redirect()->route('categories.view')->with('success', 'Data update success');
}

public function delete($id){
       $category = Category::find($id);
       $category->delete();
       return redirect()->route('categories.view')->with('success', 'Data deleted success');
} 
}
