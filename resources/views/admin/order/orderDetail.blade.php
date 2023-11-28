@extends('layouts.app')

@section('main-content')
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Order Details</li>
            </ol>
        </nav>
    </div>
    <div class="row row-sm">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Order Info</h6>
            </div>
            <div class="card-body">
                <p class="text-success text-center">
                    {{ Session('message') }}
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Delivery</th>
                            <th>Discount</th>
                            <th>Payable</th>
                            <th>Status</th>

                        </tr>
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->order_total }}</td>
                            <td>{{ $order->delivery_charge }}</td>
                            <td>{{ $order->discount }}</td>
                            <td>{{ $order->payment_amount }}</td>
                            <td>{{ $order->order_status }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Delivery Info.</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Additional Info.</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>{{ $order->delivery->first_name }}</td>
                            <td>{{ $order->delivery->phone }}</td>
                            <td>{{ $order->delivery->email }}</td>
                            <td>{{ $order->delivery->address }}</td>
                            <td>{{ $order->delivery->additional_info }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Product Info</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#.</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset($detail->product_image) }}" height="60" width="80" alt=""></td>
                                <td>{{ $detail->product_name }}</td>
                                <td>{{ $detail->product_price }}</td>
                                <td>{{ $detail->product_quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection