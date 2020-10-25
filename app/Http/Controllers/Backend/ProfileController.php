<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;

class ProfileController extends Controller
{
    public function view(){
    	$id = Auth::user()->id;
    	$user = User::find($id);
    
    return view('backend.user.profile-view', compact('user'));
       }


    public function edit(){
    	$id = Auth::user()->id;
    	$editData = User::find($id);
    
    return view('backend.user.profile-edit', compact('editData'));
       }

    public function update(Request $request){
  	$data = User::find(Auth::user()->id);
  	$data->name = $request->name;
  	$data->email = $request->email;
  	$data->mobile = $request->mobile;
  	$data->address = $request->address;
  	$data->gender = $request->gender;
  	if ($request->file('image')) {
  		$file = $request->file('image');
  		@unlink(public_path('upload/user_images/'.$data->image));
  		$filename =date('YmdHi').$file->getClientORiginalName();
  		$file->move(public_path('upload/user_images'), $filename);
  		$data['image'] = $filename;
  	}
  	$data->save();
  	return redirect()->route('profile.view')->with('success', 'Profile update success');
  }

  public function passwordView(){
  	return view('backend.user.edit-password');
  }

  public function passwordupdate(Request $request){
  	if (Auth::attempt(['id'=>Auth::user()->id, 'password'=>$request->current_password])){

  		$user = User::find(Auth::user()->id);
  		$user->password = bcrypt($request->new_password);
  		$user->save();
  		return redirect()->route('profile.view')->with('success' , 'Password changed successfully');
  	}else{
  		return redirect()->back()->with('error', 'Sorry! your current password dost not match');
  	}

  }

}
