<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public $email, $password,$customer;
    public function index()
    {
        return view('customer.home.index');
    }

    public function customerLogin(Request $request)
    {
        $this->email = $request->email;
        $this->password = $request->password;

        return view('customer.auth.login');
    }

    public function customerRegister(Request $request)
    {
        Customer::register($request);
        return back()->with('message','Your Credentials are Successfully Registered');
    }

}
