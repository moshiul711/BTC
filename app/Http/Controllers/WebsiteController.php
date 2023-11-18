<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public $categories;

    public function index()
    {
        $this->categories = Category::all();
        return view('website.home.index',['categories'=>$this->categories]);
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
