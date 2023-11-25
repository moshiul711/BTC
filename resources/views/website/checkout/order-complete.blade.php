@extends('website.master')

@section('main-content')
<div class="row mt-5">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center text-success"><i class="fa fa-check-circle"></i> Thank You for Your Order.</h2>
                <h4 class="text-center py-5">Your order number is {{ $orderNumber }}</h4>
                <h2 class="text-muted">Ordered Products</h2>
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
                            <td>{{ $detail->id }}</td>
                            <td>Kevin Powell</td>
                            <td>Business Development Associator</td>
                            <td>$50,300</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection