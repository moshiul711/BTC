@extends('customer.master')

@section('main-content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Orders</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Orders Lists</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">Order Number</th>
                                <th class="wd-15p border-bottom-0">Order Total</th>
                                <th class="wd-15p border-bottom-0">Order Date</th>
                                <th class="wd-20p border-bottom-0">Order Status</th>
                                <th class="wd-20p border-bottom-0">Payment Amount</th>
                                <th class="wd-20p border-bottom-0">Payment Method</th>
                                <th class="wd-20p border-bottom-0">Payment Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->order_total }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->payment_amount }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW-1 END-->
@endsection