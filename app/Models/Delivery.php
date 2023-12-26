<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Delivery extends Model
{
    use HasFactory;
    private static $delivery;
    public static function storeDeliveryInfo($request)
    {
        $query = http_build_query([
            'apikey'=>'83f4751692fdf3f6',
            'secretkey'=>'33b1e9a8',
            'callerID'=>'wsc',
            'toUser'=>'01893791757',
            'messageContent'=>'MESSAGE'
        ]);

        $c = curl_init();
        curl_setopt($c , CURLOPT_URL , 'https://sms.dinisoftbd.com:7790/sendtext?' . $query);
        curl_exec($c);
        curl_close($c);
        self::$delivery = new Delivery();
        self::$delivery->customer_id = Session::get('customer_id');
        self::$delivery->first_name = $request->first_name;
        self::$delivery->last_name = $request->last_name;
        self::$delivery->email = $request->email;
        self::$delivery->phone = $request->phone;
        self::$delivery->address = $request->address;
        self::$delivery->city = $request->city;
        self::$delivery->postal_code = $request->postal_code;
        self::$delivery->additional_info = $request->additional_info;
        self::$delivery->save();
        return self::$delivery;
    }

    public static function updateDeliveryInfo($request,$id)
    {
        self::$delivery = Delivery::find($id);
        self::$delivery->phone = $request->phone;
        self::$delivery->city = $request->city;
        self::$delivery->address = $request->address;
        self::$delivery->additional_info = $request->additional_info;
        self::$delivery->save();
        return self::$delivery;
    }
}
