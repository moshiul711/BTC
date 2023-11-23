<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
class CartController extends Controller
{
    private $product,$cart;

    public function cartAdd(Request $request, $id)
    {
        $this->product = Product::find($id);
        Cart::add(
            [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'qty' => $request->qty,
                'price' => $this->product->offer_price,
                'options' =>
                    [
                        'min' => 1,
                        'max' => $this->product->stock,
                        'image' => $this->product->image
                    ]
            ]);
        return back()->with('message','Product Successfully Added to Cart.');
    }

    public function cartShow()
    {
        return view('website.cart.show');
    }

    public function cartDelete($rowId)
    {
        Cart::remove($rowId);
        return back()->with('message','Product Info Deleted From Cart.');
    }

    public function cartDestroy()
    {
        Cart::destroy();
        return back()->with('message','All Products Deleted From Cart.');
    }

    public function cartUpdate(Request $request, $rowId)
    {
        Cart::update($rowId, $request->quantity);
        return back()->with('message','Product Info Updated To Cart.');
    }
}
