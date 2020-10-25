<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Logo;

class LogoController extends Controller
{
    public function view(){
    	    $data['countlogo'] = Logo::count();
    	  
    		$data['alldata'] = Logo::all();
    		return view('backend.logo.logo-view', $data);
	}
  public function add(){
  	return view('backend.logo.add-logo');
  }

  public function store(Request $request){
  	$data = new Logo();
  	$data->created_by = Auth::user()->id;
  	if ($request->file('image')) {
  		$file = $request->file('image');
  		$filename =date('YmdHi').$file->getClientORiginalName();
  		$file->move(public_path('upload/logo_images'), $filename);
  		$data['image'] = $filename;
  	$data->save();
  	return redirect()->route('logos.view')->with('success', 'Data add success');
  }
}


  public function edit($id){
    $editData = Logo::find($id);
    return view ('backend.logo.edit-logo', compact('editData'));
  }

  public function update(Request $request, $id){
  	$data = Logo::find($id);
  	$data->updated_by = Auth::user()->id;
  	if ($request->file('image')) {
  		$file = $request->file('image');
  		@unlink(public_path('upload/logo_images/'.$data->image));
  		$filename =date('YmdHi').$file->getClientORiginalName();
  		$file->move(public_path('upload/logo_images'), $filename);
  		$data['image'] = $filename;
  	    $data->save();
  	return redirect()->route('logos.view')->with('success', 'Data update success');
  }
}
  public function delete($id){
       	$logo = Logo::find($id);
       	if (file_exists('public/upload/logo_images/' .$logo->image) AND ! empty($logo->image)) {
    			unlink('public/upload/logo_images/' . $logo->image);
    		}
       	$logo->delete();
       	return redirect()->route('logos.view')->with('success', 'Data deleted success');
  }

}
