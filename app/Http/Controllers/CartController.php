<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartShow()
    {
        return view('website.cart.show');
    }
}
