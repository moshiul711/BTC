<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Session;

class CheckoutController extends Controller
{
    private $customer, $deliveryInfo,$orderInfo,$orderDetailsInfo;
    public function index()
    {
        if (Session::get('customer_id'))
        {
            $this->customer = Customer::find(Session::get('customer_id'));
            return view('website.checkout.index',['customer'=>$this->customer]);
        }
        else
        {
            return redirect('/');
        }

    }

    public function placeOrder(Request $request)
    {
        if ($request->place_order)
        {
            $this->deliveryInfo = Delivery::storeDeliveryInfo($request);
            $this->orderInfo = Order::storeOrderInfo($request,$this->deliveryInfo->id);
            $this->orderDetailsInfo = OrderDetails::storeOrderDetails($this->orderInfo->id);

            return view('website.checkout.order-complete',[
                'orderNumber' => $this->orderInfo->order_number,
                'orderDetails' => $this->orderDetailsInfo
            ]);
        }
        else
        {
            return back();
        }
    }
}
