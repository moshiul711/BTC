@extends('website.master')
@section('title')
    {{ $category->name }} Products - Workstation Communication Limited
@endsection

@section('main-content')
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>

    @if(count($category->products) > 0)
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
                <div class="btn btn-success btn-block">
                    <marquee direction="left">
                        @foreach($coupons as $coupon)
                            <span class="mx-6">Apply Code <b>{{ $coupon->code }}</b> To Get Taka {{ $coupon->amount }} Discount. Minimum Order Tk. <b>{{ $coupon->order_amount }}</b>.</span>
                        @endforeach
                    </marquee>

                </div>
            </div>
        </div>
        <div class="row row-cards mt-5">
            <div class="col-xl-12 col-lg-12">
                <div class="row products-main">
                    @foreach($category->products as $product)
                        <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-3 product-each">
                            <div class="card item-card">
                                <div class="product-grid6 card-body">
                                    <div class="product-image6">
                                        <div class="">
                                            <img class="pop img-fluid" src="{{ asset($product->image) }}"
                                                 style="height: 150px;cursor: pointer" alt="{{ $product->name }}">
                                            <div class="top-left"
                                                 style="position: absolute;top: 2px;left: 2px;">
                                                <img src="{{ asset('/') }}website/assets/images/logo1.png" alt="" style="height:32px; width: 32px; border: 2px solid lightskyblue; border-radius: 50%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-content w-100 p-3">
                                        <div class="mb-2">
                                            <h4 class="mb-1 text-normal"><a href="{{ route('product.detail',[$product->id,$product->name]) }}" title="{{ $product->name }}">{{ substr($product->name, 0,20) }}  </a> </h4>
                                            <p class="mb-0 text-muted text-start">{{ $product->brand->name }}</p>
                                        </div>
                                        <a href="{{ route('product.detail',[$product->id,$product->name]) }}">
                                            <p class="mb-2 text-warning">
                                                <span>
                                                    <del class="text-18  ms-1"
                                                         style="color: black">Tk.{{ $product->regular_price }}
                                                    </del>
                                                </span>
                                                    <span class="badge bg-red" style="float: right">
                                                        {{ round($offer = (($product->regular_price - $product->offer_price )/$product->regular_price)*100) }}
                                                        % Off
                                                    </span>
                                            </p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p class="mb-0">
                                                        <span class="text-22 text-black text-bold">Tk.{{ $product->offer_price }}</span>
                                                    </p>
                                                    @if($product->stock > 0)
                                                        <p class="mb-0 text-success-darkest">Available</p>
                                                    @else
                                                        <p class="mb-0 text-secondary">Out of Stock</p>
                                                    @endif

                                                </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-2 text-center px-5">
                                    @if($product->stock > 0)
                                        <form id="cartAdd" action="{{ route('cart.add',$product->id) }}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="qty" value="1">
                                            <button class="btn btn-success text-bold btn-block">Add To
                                                Cart
                                            </button>
                                        </form>
                                    @else
                                        <button id="swal-timer" class="btn btn-outline-success text-bold">
                                            Add To Cart
                                        </button>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div><!-- COL-END -->
        </div>
    @else
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body text-center m-auto">
                        <h3 class="text-bold text-danger-shadow">Sorry !! No Products Found On This Page...</h3>
                        <a href="{{ route('home') }}" class="btn btn-danger-gradient text-bold">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
