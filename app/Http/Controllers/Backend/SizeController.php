<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Size;
use DB;
use App\Http\Requests\SizeRequest;

class SizeController extends Controller
{
    public function view(){
        $data['alldata'] = Size::all();
        return view('backend.size.size-view', $data);
}

public function add(){
  return view('backend.size.add-size');
}

public function store(Request $request){
    $this->validate($request, [
         'name' => 'required|unique:sizes,name'
    ]);
  $data = new Size();
  $data->created_by = Auth::user()->id;
  $data->name = $request->name;

  $data->save();
  return redirect()->route('sizes.view')->with('success', 'Data add success');
}

public function edit($id){
$editData = Size::find($id);
return view ('backend.size.edit-size', compact('editData'));
}

public function update(SizeRequest  $request, $id){
  $data = Size::find($id);
  $data->updated_by = Auth::user()->id;
  $data->name = $request->name;
   $data->save();
  return redirect()->route('sizes.view')->with('success', 'Data update success');
}

public function delete($id){
       $data = Size::find($id);
       $data->delete();
       return redirect()->route('sizes.view')->with('success', 'Data deleted success');
} 
}
