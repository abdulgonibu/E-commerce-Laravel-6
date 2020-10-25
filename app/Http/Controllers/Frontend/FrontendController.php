<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logo;
use App\Model\Slider;
use App\Model\Contact;
use App\Model\About;
use App\Model\Communicate;
use Mail;

class FrontendController extends Controller
{
    public function index(){
    	$data['logo']       = Logo::first();
    	$data['sliders']    = Slider::all();
        $data['contact']    = Contact::first();
    	return view('frontend.layouts.home', $data);
    }

    public function aboutUs(){
        $data['logo']       = Logo::first();
        $data['contact']    = Contact::first();
        $data['abouts']     = About::first();
    	return view('frontend.single-pages.aboutus',$data);
    }

    public function contactUs(){
        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
    	return view('frontend.single-pages.contactus', $data);
    }

    public function shoppingcart(){
        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        return view('frontend.single-pages.shopping-cart',$data);
    }


    public function contactstore(Request $request){
        $contact = new Communicate();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile_no = $request->mobile_no;
        $contact->address = $request->address;
        $contact->msg = $request->msg;
        $contact->save();

        $data = array(
            'name' => $request->name,
            'email'=>$request->email,
            'mobile_no'=> $request->mobile_no,
            'address' => $request->address,
            'msg' => $request->msg,
        );

        Mail::send('frontend.emails.contact', $data, function($message) use($data){
            $message->from('abdulgoni.me@gmail.com', 'Abdul Goni');
            $message->to($data['email']);
            $message->subject('Thanks for contact us');

        });
        return redirect()->back()->with('success', 'Your message successfully sent');

    }


}
