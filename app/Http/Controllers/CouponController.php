<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

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

}
