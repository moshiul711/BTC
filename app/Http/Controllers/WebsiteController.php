<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Message;
use App\Models\ProductReview;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class WebsiteController extends Controller
{
    public $featured_products, $message, $categories,$category,$subCategory, $product, $products,$customer,$reviews,$coupons,$relatedProducts,$sliders;

    public function index()
    {
        $this->coupons = Coupon::where('status',1)->get();
        $this->categories = Category::all();
        $this->sliders = Slider::all();
        $this->featured_products = Product::where('featured_status',1)->get();
        return view('website.home.index',
            [
                'categories' => $this->categories,
                'coupons' => $this->coupons,
                'sliders' => $this->sliders,
                'products' => $this->featured_products
            ]
        );
    }

    public function about()
    {
        return view('website.home.about');
    }

    public function privacy()
    {
        return view('website.home.privacy');
    }
    public function refund()
    {
        return view('website.home.refund');
    }
    public function delivery()
    {
        return view('website.home.delivery');
    }


    public function productDetail($id,$name)
    {
        $this->product = Product::where(['id' =>$id,'name' => $name])->first();
        if (!$this->product)
        {
            return view('website.home.error');
        }
        else
        {
//            $this->reviews = ProductReview::where('product_id',$id)->get();
            $this->product->hit_count = $this->product->hit_count+1;
            $this->product->save();
            $this->relatedProducts = Product::where('sub_category_id',$this->product->sub_category_id)->get();
            return view('website.product.detail',[
                'product' => $this->product,
                'relatedProducts' => $this->relatedProducts
            ]);
        }
    }

    public function productQuickView()
    {
//        return response()->json(Product::where('id',$_GET['id'])->first());
        $this->product = Product::where('id',$_GET['id'])->first();
        return view('website.product.quick-view',['product'=>$this->product]);
    }

    public function productReview(Request $request, $id)
    {
        ProductReview::storeReview($request,$id);
        return back()->with('message','Thanks To Share Your Review...');
    }

    public function productCategory($id,$name)
    {
        $this->coupons = Coupon::where('status',1)->get();
        $this->category = Category::where(['id'=>$id,'name'=>$name])->first();
        return view('website.product.category-show',['category'=>$this->category,'coupons'=>$this->coupons]);
    }
    public function productSubcategory($id,$name)
    {
        $this->coupons = Coupon::where('status',1)->get();
        $this->subCategory = SubCategory::where(['id'=>$id,'name'=>$name])->first();
        return view('website.product.subCategory-show',['subCategory'=>$this->subCategory,'coupons'=>$this->coupons]);
    }

    public function contact()
    {
        return view('website.home.contact');
    }

    public function message(Request $request)
    {
        $this->message = Message::storeMessage($request);
        return back()->with('contact','Thank You for Contacting Us. We will Contact You Shortly');
    }

    public function referEarn()
    {
        return view('website.home.refer');
    }
    public function faq()
    {
        return view('website.home.faqs');
    }

    public function productSearch(Request $request)
    {
        $this->coupons = Coupon::where('status',1)->get();
        $this->products = Product::where('name','LIKE',"%{$request->search}%")->orWhere('long_description','LIKE',"%{$request->search}%")->orWhere('short_description','LIKE',"%{$request->search}%")->get();
        if (count($this->products)>0){
            return view('website.product.show',['products'=>$this->products,'coupons'=>$this->coupons]);
        }
        else{
            return view('website.home.error');
        }
    }
}
