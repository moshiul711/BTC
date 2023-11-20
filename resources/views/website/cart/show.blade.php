@extends('website.master')


@section('main-content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Cart Products</li>
            </ol>
        </nav>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-xl-8 col-md-12">
            <div class="card cart">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Shopping Cart</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-vcenter text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>Preview</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                            <tbody>
                                @foreach(Cart::content() as $item)
                                    <form action="{{ route('cart.update',$item->rowId) }}" method="post">
                                    @csrf
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->options->image) }}" alt="" class="cart-img">
                                        </td>
                                        <td>{{ substr($item->name,0,30) }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <input type="number"  name="quantity" class="form-control text-center" value="{{ $item->qty }}" >
                                        </td>
                                        <td>
                                            {{ round($item->qty * $item->price) }}
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-square btn-success-light me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Update"><i class="fa fa-edit fs-13"></i></button>
                                            <a href="{{ route('cart.delete',$item->rowId) }}" class="btn btn-square btn-danger-light me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove From Cart"><i class="icon icon-trash fs-13"></i></a>
                                        </td>
                                    </tr>
                                    </form>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Have coupon?</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <div class="input-group"> <input type="text" id="myInput" class="form-control coupon" placeholder="Coupon code"> <span class="input-group-btn"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Price Details</h3>
                </div>
                <div class="card-body">
                    <table class="table border-top-0">
                        <tr>
                            <td class="border-top-0">Sub Total</td>
                            <td class="text-end border-top-0">$4,360</td>
                        </tr>
                        <tr>
                            <td class="border-top-0">Discount</td>
                            <td class="text-end border-top-0">5%</td>
                        </tr>
                        <tr>
                            <td class="border-top-0">Shipping</td>
                            <td class="text-end border-top-0">Free</td>
                        </tr>
                        <tr>
                            <td class="fs-20 border-top-0">Total</td>
                            <td class="text-end fs-20 border-top-0">$3,976</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="step-footer text-end">
                        <a href="products.html" class="btn btn-primary my-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class=" w-inner-icn" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M17.5,11.5H7.7069702l4.6465454-4.6464844c0.1972046-0.1932373,0.2003784-0.5097656,0.0071411-0.7069702c-0.1932983-0.1972046-0.5098267-0.2004395-0.7070312-0.0071411c-0.0023804,0.0023193-0.0047607,0.0046997-0.0071411,0.0071411l-5.5,5.5c-0.1953125,0.1950684-0.1956177,0.5113525-0.0005493,0.706665c0.0001221,0.0001831,0.0002441,0.0003052,0.0005493,0.0003052l5.5,5.5c0.1972046,0.1932373,0.5137329,0.1900635,0.7069702-0.0071411c0.1905518-0.194397,0.1905518-0.5054932,0-0.6998901L7.7069702,12.5H17.5c0.276123,0,0.5-0.223877,0.5-0.5S17.776123,11.5,17.5,11.5z"/></svg>
                            Continue Shopping
                        </a>
                        <a href="checkout.html" class="btn btn-info my-1">
                            Check out
                            <svg xmlns="http://www.w3.org/2000/svg" class=" w-inner-icn" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M17.8536377,11.6466064c-0.000061-0.000061-0.0001221-0.000061-0.0001221-0.0001221l-5.5-5.5c-0.1986084-0.1918335-0.5151367-0.1863403-0.7069702,0.0122681c-0.1871338,0.1937866-0.1871338,0.5009766,0,0.6947021L16.2930298,11.5H6.5C6.223877,11.5,6,11.723877,6,12s0.223877,0.5,0.5,0.5h9.7930298l-4.6465454,4.6464844c-0.1986084,0.1918335-0.2041016,0.5083618-0.0122681,0.7069702c0.1918335,0.1986694,0.5084229,0.2041626,0.7070312,0.0123291c0.0041504-0.0040283,0.0082397-0.0081177,0.0122681-0.0123291l5.5-5.5C18.0487671,12.1583252,18.0487671,11.8418579,17.8536377,11.6466064z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- COL-END -->
    <!-- ROW-1 CLOSED -->
@endsection
