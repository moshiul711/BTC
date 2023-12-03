<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\Courier;
use PDF;

class AdminController extends Controller
{
    public $orders, $order,$orderDetails,$product,$stock_amount;
    public function index()
    {
        return view('admin.home.index');
    }

    public function allOrder()
    {
        $this->orders = Order::all();
        return view('admin.order.index',['orders'=>$this->orders]);
    }

    public function orderDetail($id)
    {
        $this->order = Order::where('order_number',$id)->first();
        return view('admin.order.orderDetail',['order'=>$this->order]);
    }

    public function orderEdit($id)
    {
        $this->couriers = Courier::all();
        $this->order = Order::where('order_number',$id)->first();
        return view('admin.order.orderEdit',['order'=>$this->order,'couriers'=>$this->couriers]);
    }

    public function orderUpdate(Request $request, $id)
    {
        $this->order = Order::updateOrder($request,$id);
        Delivery::updateDeliveryInfo($request,$this->order->delivery_id);
        if ($request->order_status == 'cancel')
        {
            OrderDetails::updateProductStock($this->order->id);
        }
        return redirect('/admin/order')->with('message','Order Info Updated Successfully...');
    }

    public function orderInvoice($id)
    {
        $this->order = Order::where('order_number',$id)->first();
        return view('admin.order.orderInvoice',['order'=>$this->order]);
    }

    public function orderDownload($id)
    {
        $this->order = Order::where('order_number',$id)->first();
        $pdf = PDF::loadView('admin.order.orderDownload',['order'=>$this->order]);
        return $pdf->stream('BTC-'.$this->order->order_number.'.pdf');
    }
    public function orderDelete($id)
    {
        $this->order = Order::where('order_number',$id)->first();
        if ($this->order->order_status == 'cancel')
        {
            Order::deleteOrder($this->order->id);
            OrderDetails::deleteOrderDetail($this->order->id);
            return back()->with('message', 'Order Info delete successfully');
        }
        return back()->with('message', 'Sorry ... this order can not be deleted.');
    }
}
