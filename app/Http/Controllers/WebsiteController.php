<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class WebsiteController extends Controller
{
    public $categories, $product,$customer;

    public function index()
    {
        $this->categories = Category::all();
        return view('website.home.index',['categories'=>$this->categories]);
    }

    public function productDetail($id)
    {
        $this->product = Product::find($id);
        if (!$this->product){
            return view('website.home.error');
        }
        return view('website.product.detail',['product'=>$this->product]);
    }

    public function productReview(Request $request, $id)
    {
        ProductReview::storeReview($request,$id);
        return back()->with('message','Thanks To Share Your Review...');
    }

    public function productShow()
    {
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
