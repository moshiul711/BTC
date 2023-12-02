@extends('website.master')


@section('main-content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </nav>
    </div>
    <!-- PAGE-HEADER END -->
    @if(Cart::Count()>0)
        <form action="{{ route('order-place') }}" method="post">
            @csrf
        <!-- ROW-1 OPEN -->
        <div class="row">
            <div class="col-xl-8 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Billing Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">First Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" value="{{ $customer->first_name }}" placeholder="First name" name="first_name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" value="{{ $customer->last_name }}" name="last_name" placeholder="Last name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Email address <span class="text-red">*</span></label>
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ $customer->email }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Phone <span class="text-red">*</span></label>
                                    <input type="tel" value="{{ $customer->phone }}" name="phone" class="form-control" placeholder="Phone">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Address <span class="text-red">*</span></label>
                                    <textarea class="form-control" placeholder="Home Address" name="address">{{ $customer->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="form-label">City <span class="text-red">*</span></label>
                                    <select name="city" class="form-control">
                                        <option value="">---Select City---</option>
                                        <option value="dhaka">Dhaka</option>
                                        <option value="chittagong">Chittagong</option>
                                        <option value="rajshahi">Rajshahi</option>
                                        <option value="khulna">Khulna</option>
                                        <option value="barishal">Barishal</option>
                                        <option value="mymensingh">Mymensingh</option>
                                        <option value="rongpur">Rongpur</option>
                                        <option value="sylhet">Sylhet</option>
                                    </select>
                                </div>
                            </div>
                            {{--<div class="col-sm-6 col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="form-label" for="distr">Select District<span class="text-red">*</span></label>--}}
                                    {{--<select name="" class="form-control" id="distr" onchange="thanaList();"></select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="col-sm-6 col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="form-label" for="polic_sta">Select Police Station<span class="text-red">*</span></label>--}}
                                    {{--<select class="form-control" name="" id="polic_sta"></select>--}}
                                {{--</div>--}}
                            {{--</div>--}}



                            {{--<div class="col-sm-6 col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label class="form-label">Postal Code <span class="text-red">*</span></label>--}}
                                    {{--<input type="number" value="{{ $customer->postal_code }}" name="postal_code" class="form-control" placeholder="ZIP Code">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Additional Information<span class="text-red">*</span></label>
                                    <textarea class="form-control" rows="5" placeholder="Any Other Additional Information" name="additional_info"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Payment Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-pay">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12" >
                                    <label>
                                        <input name="payment" required type="radio" value="cod" checked>
                                        <img src="{{ asset('/') }}website/assets/icons/cod_icon.webp" alt="">
                                    </label>
                                    <label>
                                        <input name="payment" required type="radio" value="online">
                                        <img src="{{ asset('/') }}website/assets/icons/ssl1.png" alt="">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card cart">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Your Order(s)</h3>
                    </div>
                    <div class="card-body">
                        @foreach(Cart::content() as $item)
                        <div class="d-md-flex">
                            <div class="d-flex py-2">
                                <img class="img-fluid avatar-xl border p-0 br-7" src="{{ asset($item->options->image) }}" alt="img">
                                <div class="ms-3 mt-2">
                                    <h4 class="mb-1 fw-semibold fs-14"><a href="{{ route('product.detail',[$item->id,$item->name]) }}">{{ $item->name }}</a></h4>
                                    <p class="fs-12 fw-300 lh-1 mb-0">Price: <span class="text-green">{{ $item->price }}</span></p>
                                    <span class="fs-12 fw-300 lh-1 mb-0">Quantity: {{ $item->qty }}</span>
                                    {{--<h6 class="text-success">({{ $item->qty.'*'.$item->price }})</h6>--}}
                                </div>
                            </div>
                            <div class="ms-auto my-auto">
                                <span class="me-4 my-auto fs-16 fw-semibold">Tk.{{ $item->qty*$item->price }}</span>
                            </div>
                        </div>
                        @endforeach
                        <table class="table mt-5">
                            <tr>
                                <td class="border-top-0">Sub Total</td>
                                <td class="text-end border-top-0">Tk. {{ $subTotal = round(Cart::subtotal()) }}</td>
                            </tr>
                            <tr>
                                <td class="border-top-0">Discount</td>
                                @if(Session::get('coupon'))
                                    <td class="text-end border-top-0">{{ $discount = Session::get('coupon') }}</td>
                                @else
                                    <td class="text-end border-top-0">{{ $discount = 0 }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="border-top-0">Shipping</td>
                                <td class="text-end border-top-0">Tk. {{ $shipping = 110 }}</td>
                            </tr>
                            <tr>
                                <td class="fs-20 border-top-0">Total</td>
                                @php($total = ($subTotal))
                                <td class="text-end fs-20 border-top-0">Tk. {{ $payable = round($subTotal+$shipping - $discount) }}</td>
                            </tr>
                        </table>
                    </div>
                    <?php
                    Session::put('order_total',$subTotal);
                    Session::put('delivery_charge',$shipping);
                    Session::put('payment_amount',$payable);
                    Session::put('discount',$discount);
                    ?>
                    <div class="card-footer text-end">
                        <button type="submit" name="place_order" value="place_order" class="btn btn-success" style="display: block;width: 100%">Place Order</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
        <!-- ROW-1 CLOSED -->
        </form>
    @else
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title text-center text-success-darkest">There is no product found in the cart</p>
                        <span>
                        <p class="text-center text-success-darkest text-bold">Add Some product first</p>
                    </span>
                        <div class="text-center">
                            <a href="{{ route('home') }}" class="btn btn-outline-success">Go Back To Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endsection
