<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $product;
    public function cartAdd($id)
    {
        return $this->product = Product::find($id);
    }
}
