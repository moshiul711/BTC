<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOtherImage;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $product,$products,$categories,$subCategories,$brands,$units;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->products = Product::all();
        return view('admin.product.index',['products'=>$this->products]);
    }

    public function productDetail()
    {
        return view('website.product.detail');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->categories = Category::all();
        $this->subCategories = SubCategory::all();
        $this->brands = Brand::all();
        $this->units = Unit::all();
        return view('admin.product.create',[
            'categories' => $this->categories,
            'sub_categories' => $this->subCategories,
            'brands'=> $this->brands,
            'units' => $this->units
        ]);
    }

    public function getCategoryBySubCategory()
    {
        return response()->json(SubCategory::where('category_id', $_GET['id'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->product = Product::storeProduct($request);
        ProductOtherImage::storeOtherImages($request->file('other_image'),$this->product->id);
        return back()->with('message','Product Uploaded Successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
