<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Session;

class CouponController extends Controller
{
    public $coupons, $coupon;
    public function index()
    {
        $this->coupons = Coupon::all();
        return view('admin.coupon.manage',['coupons'=>$this->coupons]);
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        Coupon::storeCoupon($request);
        return back()->with('message','Coupon Created Successfully..');
    }

    public function edit($id)
    {
        $this->coupon = Coupon::find($id);
        return view('admin.coupon.edit',['coupon'=>$this->coupon]);
    }

    public function update(Request $request, $id)
    {
        Coupon::updateCoupon($request,$id);
        return redirect('/coupon/index')->with('message','Coupon Updated Successfully..');
    }

    public function delete($id)
    {
        $this->coupon = Coupon::find($id);
        return back()->with('message','Coupon Info Deleted Successfully..');
    }

    public function apply(Request $request)
    {
        $this->coupon = Coupon::where('code',$request->coupon)->first();
        if ($this->coupon)
        {
            if (Session::get('customer_id'))
            {
                Session::put('coupon',$this->coupon->amount);
                return response()->json(['message'=>'Coupon Applied Successfully']);
            }
            else{
                return response()->json(['error'=>'Login First To Apply Coupon']);
            }
        }

        else
        {
            return response()->json(['error'=>'Coupon You Have Applied Not Found']);
        }

    }

}
