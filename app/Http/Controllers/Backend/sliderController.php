<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Model\Slider;

class sliderController extends Controller
{
    public function view(){
    		$data['alldata'] = Slider::all();
    		return view('backend.slider.slider-view', $data);
	}

  public function add(){
  	return view('backend.slider.add-slider');
  }

  public function store(Request $request){
  	$data = new Slider();
  	$data->created_by = Auth::user()->id;
  	$data->short_title = $request->short_title;
  	$data->long_title = $request->long_title;
  	if ($request->file('image')) {
  		$file = $request->file('image');
  		$filename =date('YmdHi').$file->getClientORiginalName();
  		$file->move(public_path('upload/slider_images'), $filename);
  		$data['image'] = $filename;
  	    $data->save();
  	return redirect()->route('sliders.view')->with('success', 'Data add success');
  }
}


  public function edit($id){
    $editData = Slider::find($id);
    return view ('backend.slider.edit-slider', compact('editData'));
  }

  public function update(Request $request, $id){
  	$data = Slider::find($id);
  	$data->updated_by = Auth::user()->id;
  	if ($request->file('image')) {
  		$file = $request->file('image');
  		@unlink(public_path('upload/slider_images/'.$data->image));
  		$filename =date('YmdHi').$file->getClientORiginalName();
  		$file->move(public_path('upload/slider_images'), $filename);
  		$data['image'] = $filename;
  	    $data->save();
  	return redirect()->route('sliders.view')->with('success', 'Data update success');
  }
}
  public function delete($id){
       	$slider = Slider::find($id);
       	if (file_exists('public/upload/slider_images/' .$slider->image) AND ! empty($slider->image)) {
    			unlink('public/upload/slider_images/' . $slider->image);
    		}
       	$slider->delete();
       	return redirect()->route('sliders.view')->with('success', 'Data deleted success');
  }
}
