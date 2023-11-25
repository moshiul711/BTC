<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public $email, $password,$customer,$reviews;
    public function index()
    {
        return view('customer.home.index');
    }

    public function login(Request $request)
    {
        $this->customer = Customer::where('email',$request->email)->first();
        if ($this->customer)
        {
            if (password_verify($request->password,$this->customer->password))
            {
                echo Session::put('customer_id', $this->customer->id);
                echo Session::put('customer_name', $this->customer->first_name);
                echo Session::put('customer_image', $this->customer->image);
                return back()->with('message','You Successfully Login..');
            }
            else
            {
                return back()->with('message', 'Sorry ... your password is invalid.');
            }
        }
        else
        {
            return back()->with('message', 'Sorry ... your email or mobile is invalid.');
        }
    }

    public function register(Request $request)
    {
        Customer::register($request);
        return back()->with('message','Your Credentials are Successfully Registered');
    }

    public function profile()
    {
        $this->customer = Customer::find(Session::get('customer_id'));
        return view('customer.home.profile',['customer'=>$this->customer]);
    }

    public function update(Request $request)
    {
        Customer::updateProfile($request);
        return back()->with('message','Thanks For Updating Your Profile...');
    }

    public function logout()
    {
        Session::forget('customer_id');
        Session::forget('customer_name');
        Session::forget('customer_image');

        return back()->with('message','Your are logged out.');;
    }

    public function review(Request $request,$product_id)
    {
        ProductReview::storeReview($request,$product_id);
        return back()->with('message','Thanks For Your Review...');
    }

    public function allReview()
    {
        $this->reviews = ProductReview::where('customer_id',Session::get('customer_id'))->get();
        return view('customer.review.index',['reviews'=>$this->reviews]);
    }

}
