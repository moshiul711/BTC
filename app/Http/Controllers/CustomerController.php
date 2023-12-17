<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public $email, $password,$customer,$reviews,$orders,$order,$check;
    public function index()
    {
        $this->orders = Order::where('customer_id',Session::get('customer_id'))->orderBy('id','desc')->get();
        return view('customer.home.index',['orders'=>$this->orders]);
    }

    public function login(Request $request)
    {
        $this->customer = Customer::where('email',$request->email)->first();

        if ($this->customer)
        {
            if (password_verify($request->password,$this->customer->password))
            {
                Session::put('customer_id', $this->customer->id);
                Session::put('customer_name', $this->customer->first_name);
                Session::put('customer_city', $this->customer->city);
//                if ($this->customer->image)
//                {
//                    Session::put('customer_image', $this->customer->image);
//                }
//                else
//                    {
//                        Session::put('customer_image', 'website/assets/icons/profile.png');
//                    }

                return back()->with('message','You Successfully Login..');
            }
            else
            {
                return back()->with('logout', 'Sorry ... your password is invalid.');
            }
        }
        else
        {
            return back()->with('logout', 'Sorry ... your email or mobile is invalid.');
        }
    }

    public function register(Request $request)
    {
        $this->customer = Customer::register($request);
        if ($this->customer)
        {
            Session::put('customer_id', $this->customer->id);
            Session::put('customer_name', $this->customer->first_name);
//            Session::put('customer_image', 'website/assets/icons/profile.png');
        }
        return back()->with('message','Your Credentials are Successfully Registered');
    }

    public function profile()
    {
        $this->customer = Customer::find(Session::get('customer_id'));
        return view('customer.home.profile',['customer'=>$this->customer]);
    }

    public function update(Request $request)
    {
        $this->customer = Customer::updateProfile($request);
        Session::put('customer_id', $this->customer->id);
        Session::put('customer_name', $this->customer->first_name);
//        Session::put('customer_image', $this->customer->image);
        Session::put('customer_city', $this->customer->city);
        return back()->with('message','Thanks For Updating Your Profile...');
    }

    public function logout()
    {
        Session::forget('customer_id');
        Session::forget('customer_name');
//        Session::forget('customer_image');
        Session::forget('customer_city');

        return redirect('/')->with('logout','Your are logged out.');;
    }

    public function review(Request $request,$product_id)
    {
        ProductReview::storeReview($request,$product_id);
        return back()->with('message','Thanks For Your Review...');
    }

    public function allReview()
    {
        $this->reviews = ProductReview::where('customer_id',Session::get('customer_id'))->get();
        return view('customer.home.review',['reviews'=>$this->reviews]);
    }

    public function order()
    {
        $this->orders = Order::where('customer_id',Session::get('customer_id'))->get();
        return view('customer.home.orders',['orders'=>$this->orders]);
    }

    public function orderDetail($id)
    {
        $this->customer = Session::get('customer_id');
        $this->order = Order::where(['order_number'=>$id, 'customer_id'=>$this->customer])->first();
        if (!$this->order)
        {
            return view('website.home.error');
        }
        return view('customer.home.orderDetail',['order'=>$this->order]);
    }

    public function changePassword()
    {
        return view('customer.home.password');
    }

    public function updatePassword(Request $request)
    {
        $this->customer = Customer::find(Session::get('customer_id'));
        if (password_verify($request->password,$this->customer->password)){
            if ($request->new_password == $request->confirm_new_password){
                Customer::updatePassword($this->customer->id, $request->new_password);
                return back()->with('message','Password Changed Successfully');
            }
            else{
              return back()->with('logout','New Password & Confirm Password not Matched');
            }
        }
        else{
            return back()->with('logout','Your Password Is Not Matched to Our Database');
        }
    }


    public function forgotPassword()
    {
        return view('website.home.forgotPassword');
    }

    public function forgotEmailCheck(Request $request)
    {
        $this->customer = Customer::forgetPassword($request);
        if ($this->customer)
        {
            return view('website.home.changePassword',['customer'=>$this->customer]);
        }
        else
        {
            return back()->with('message','Your Information Not Found');
        }
    }

    public function recoveryPassword(Request $request, $id)
    {
        $this->check = Customer::updatePassword($id,$request->new_password);
        return view('website.home.login');
    }

}
