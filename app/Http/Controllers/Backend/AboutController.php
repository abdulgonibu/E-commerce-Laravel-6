<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\About;

class AboutController extends Controller
{
    public function view(){
    		$data['alldata'] = About::all();
    		return view('backend.about.about-view', $data);
	}

  public function add(){
  	return view('backend.about.add-about');
  }

  public function store(Request $request){
  	$data = new About();
  	$data->created_by = Auth::user()->id;
  	$data->descrition = $request->descrition;

  	$data->save();
  	return redirect()->route('abouts.view')->with('success', 'Data add success');
  }



  public function edit($id){
    $editData = About::find($id);
    return view ('backend.about.edit-about', compact('editData'));
  }

  public function update(Request $request, $id){
  	$data = About::find($id);
  	$data->updated_by = Auth::user()->id;
  	$data->descrition = $request->descrition;
  	

  	 $data->save();
  	return redirect()->route('abouts.view')->with('success', 'Data update success');
  }

  public function delete($id){
       	$about = About::find($id);
       	$about->delete();
       	return redirect()->route('abouts.view')->with('success', 'Data deleted success');
  }
}
