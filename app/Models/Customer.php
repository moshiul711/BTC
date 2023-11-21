<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public static $customer;
    public static function register($request)
    {
        self::$customer = new Customer();
        self::$customer->first_name = $request->first_name;
        self::$customer->last_name = $request->last_name;
        self::$customer->email = $request->email;
        self::$customer->phone = $request->phone;
        self::$customer->password = bcrypt($request->password);
        self::$customer->save();
    }
}
