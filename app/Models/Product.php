<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    private static $product,$imageUrl,$image,$imageName,$imageExt,$imageFullName,$imagePath;

    public static function storeProduct($request)
    {
        self::$product = new Product();
        self::$imageUrl = self::uploadProductImage($request);
        return self::saveProductInfo(self::$product,$request,self::$imageUrl);
    }

    public static function uploadProductImage($request)
    {
        self::$image = $request->file('image');
        self::$imageName = substr(md5(time()),0,8);
        self::$imageExt = self::$image->getClientOriginalExtension();
        self::$imageFullName = self::$imageName.'.'.self::$imageExt;
        self::$imagePath = 'uploads/product-image/';
        self::$image->move(self::$imagePath,self::$imageFullName);
        return self::$imageUrl = self::$imagePath.self::$imageFullName;
    }

    public static function saveProductInfo($product,$request,$imageUrl)
    {
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->regular_price = $request->regular_price;
        $product->offer_price = $request->offer_price;
        $product->stock = $request->stock;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->image = $imageUrl;
        $product->save();
        return $product;
    }

    public static function deleteProduct($id)
    {
        self::$product = Product::find($id);
        if (file_exists(self::$product->image))
        {
            unlink(self::$product->image);
        }
        return self::$product->delete();
    }


    public function otherImages()
    {
        return $this->hasMany(ProductOtherImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
