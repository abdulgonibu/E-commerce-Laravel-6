<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Color;
use DB;
use App\Http\Requests\randRequest;

class ColorController extends Controller
{
    public function view(){
        $data['alldata'] = Color::all();
        return view('backend.color.color-view', $data);
}

public function add(){
  return view('backend.color.add-color');
}

public function store(Request $request){
    $this->validate($request, [
         'name' => 'required|unique:colors,name'
    ]);
  $data = new Color();
  $data->created_by = Auth::user()->id;
  $data->name = $request->name;

  $data->save();
  return redirect()->route('colors.view')->with('success', 'Data add success');
}

public function edit($id){
$editData = Color::find($id);
return view ('backend.color.edit-color', compact('editData'));
}

public function update(BrandRequest  $request, $id){
  $data = Color::find($id);
  $data->updated_by = Auth::user()->id;
  $data->name = $request->name;
   $data->save();
  return redirect()->route('colors.view')->with('success', 'Data update success');
}

public function delete($id){
       $data = Color::find($id);
       $data->delete();
       return redirect()->route('colors.view')->with('success', 'Data deleted success');
} 
}
