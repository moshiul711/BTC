<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public $email, $password,$customer;
    public function index()
    {
        return view('customer.home.index');
    }

    public function customerLogin(Request $request)
    {
        $this->customer = Customer::where('email',$request->email)->first();
        if ($this->customer)
        {
            if (password_verify($request->password,$this->customer->password))
            {
                Session::put('customer_id', $this->customer->id);
                Session::put('customer_name', $this->customer->name);
                Session::put('customer_image', $this->customer->image);
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

    public function customerRegister(Request $request)
    {
        Customer::register($request);
        return back()->with('message','Your Credentials are Successfully Registered');
    }

    public function customerLogout()
    {
        Session::forget('customer_id');
        Session::forget('customer_name');
        Session::forget('customer_image');

        return back()->with('message','Your are logged out.');;
    }

}
