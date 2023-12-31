@extends('website.master')
@section('title')
    Complete Order - Workstation Communication Limited
@endsection
@section('main-content')
<div class="row mt-5">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center text-success"><i class="fa fa-check-circle"></i> Thank You for Your Order.</h2>
                <h4 class="text-center py-3">We Will Contact You Very Soon.</h4>
                <h4 class="text-center pb-5">Your order number is {{ $orderNumber }}</h4>
                <h2 class="text-center">Ordered Products</h2>
                <div class="table-responsive">
                    <table class="table border text-nowrap text-md-nowrap table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderDetails as $detail)
                        <tr>
                            <td>
                                <img src="{{ asset($detail['product_image']) }}" class="img-thumbnail" height="40" width="60" alt="">
                            </td>
                            <td>{{ $detail['product_name'] }}</td>
                            <td>{{ $detail['product_quantity'] }}</td>
                            <td>{{ $detail['product_price'] }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10"><h4 class="text-center">To track the delivery of your order, go to My Account > My Order</h4></div>
                    <div class="col-md-2">
                        <a href="{{ route('customer.order') }}" class="btn btn-success">View Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection