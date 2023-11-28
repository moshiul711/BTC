<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cart;
use Session;

class Order extends Model
{
    use HasFactory;
    private static $order;
    public static function storeOrderInfo($request,$deliveryId)
    {
        self::$order = new Order();
        self::$order->order_number = rand('1000000000','999999999999999');
        self::$order->customer_id = Session::get('customer_id');
        self::$order->delivery_id = $deliveryId;
        self::$order->delivery_charge = Session::get('delivery_charge');
        self::$order->order_date = date('Y-m-d');
        self::$order->order_timestamp = strtotime(date('Y-m-d'));
        self::$order->order_total = Session::get('order_total');
        self::$order->discount = Session::get('discount');
        Session::forget('coupon');
        self::$order->payment_amount = Session::get('payment_amount');
        self::$order->payment_method = $request->payment;

        self::$order->save();
        return self::$order;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

}
