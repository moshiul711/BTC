<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\ProductReview;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class WebsiteController extends Controller
{
    public $categories, $product, $products,$customer,$reviews,$coupons;

    public function index()
    {
        $this->coupons = Coupon::where('status',1)->get();
        $this->categories = Category::all();
        return view('website.home.index',['categories'=>$this->categories,'coupons'=>$this->coupons]);
    }

    public function productDetail($id,$name)
    {
        $this->product = Product::where(
            [
                'id' =>$id,
                'name' => $name
            ]
        )->first();
        if (!$this->product)
        {
            return view('website.home.error');
        }
        elseif ($this->product->stock < 1)
        {
            return view('website.home.error');
        }
        else
        {
//            $this->reviews = ProductReview::where('product_id',$id)->get();
            $this->product->hit_count = $this->product->hit_count+1;
            $this->product->save();
            return view('website.product.detail',[
                'product' => $this->product,
            ]);
        }
    }

    public function productReview(Request $request, $id)
    {
        ProductReview::storeReview($request,$id);
        return back()->with('message','Thanks To Share Your Review...');
    }

    public function productSubcategory($id,$name)
    {
        return $this->products = SubCategory::where('id',$id)->where('name',$name)->first();
        return view('website.product.show');
    }

    public function contact()
    {
        return view('website.home.contact');
    }

    public function referEarn()
    {
        return view('website.home.refer');
    }
    public function faq()
    {
        return view('website.home.faqs');
    }
}
