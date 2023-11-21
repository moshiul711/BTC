<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Session;

class CheckoutController extends Controller
{
    private $customer;
    public function index()
    {
        if (Session::get('customer_id'))
        {
            $this->customer = Customer::find(Session::get('customer_id'))->first();
            return view('website.checkout.index',['customer'=>$this->customer]);
        }
        else
        {
            return redirect('/');
        }

    }
}
