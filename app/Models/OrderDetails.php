<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cart;

class OrderDetails extends Model
{
    use HasFactory;
    private static $orderDetails;
    public static function storeOrderDetails($orderId)
    {
        $data = [];
        foreach (Cart::content() as $key => $item)
        {
            self::$orderDetails = new OrderDetails();
            self::$orderDetails->order_id = $orderId;
            self::$orderDetails->product_id = $item->id;
            self::$orderDetails->product_name = $item->name;
            self::$orderDetails->product_price = $item->price;
            self::$orderDetails->product_quantity = $item->qty;
            self::$orderDetails->save();
            Cart::remove($item->rowId);

            $data[$key]['id'] = self::$orderDetails->id;
            $data[$key]['product_id'] = $item->id;
            $data[$key]['product_name'] = $item->name;
            $data[$key]['product_price'] = $item->price;
            $data[$key]['product_quantity'] = $item->qty;
        }
        return $data;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
