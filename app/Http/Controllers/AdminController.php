<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $orders;
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
        $this->order = Order::find($id);
        return view('admin.order.orderDetail',['order'=>$this->order]);
    }

    public function orderEdit($id)
    {
        $this->couriers = Courier::all();
        $this->order = Order::find($id);
        $this->shippingInfo = DB::table('orders')
            ->join('shipping_infos', 'orders.shippingInfo_id','=','shipping_infos.id')
            ->where('shipping_infos.id','=',$this->order->shippingInfo_id)->first();
        return view('admin.order.orderEdit',['order'=>$this->order,'couriers'=>$this->couriers,'shippingInfo'=>$this->shippingInfo]);
    }

    public function orderUpdate(Request $request, $id)
    {
        $this->order = Order::find($id);
        ShippingInfo::updateShippingInfo($request,$this->order->shippingInfo_id);
        Order::updateOrder($request,$id);
        return redirect('admin/order-manage')->with('message','Order Updated Successfully...');
    }

    public function orderInvoice($id)
    {
        $this->order = Order::find($id);
        $this->shippingInfo = DB::table('orders')
            ->join('shipping_infos', 'orders.shippingInfo_id','=','shipping_infos.id')
            ->where('shipping_infos.id','=',$this->order->shippingInfo_id)->first();
        return view('admin.order.orderInvoice',['order'=>$this->order,'shippingInfo'=>$this->shippingInfo]);
    }

    public function orderDownload($id)
    {
        $this->order = Order::find($id);
        $this->shippingInfo = DB::table('orders')
            ->join('shipping_infos', 'orders.shippingInfo_id','=','shipping_infos.id')
            ->where('shipping_infos.id','=',$this->order->shippingInfo_id)->first();
        $pdf = PDF::loadView('admin.order.orderDownload',['order'=>$this->order,'shippingInfo'=>$this->shippingInfo]);
        return $pdf->stream('invoice-'.$id.'.pdf');
        //$this->order = Order::find($id);
    }
}
