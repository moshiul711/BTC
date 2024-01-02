@extends('website.master')

@section('title')
Workstation Communication Limited
@endsection

@section('slider')
    <div class="row mt-2">
        <div class="col-md-12 ">
            <div id="carousel-controls" class=" carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" style="border: 1px solid #80bc5b">
                    {{--<div class="carousel-item active">--}}
                        {{--<img class="d-block w-100" alt="" src="{{ asset('/') }}website/assets/icons/s.jpg"--}}
                             {{--data-bs-holder-rendered="true">--}}
                    {{--</div>--}}
                    @foreach($sliders as $slider)
                        @if($slider->id ==1)
                        <div class="carousel-item active">
                            <img class="d-block w-100" alt="" src="{{ asset($slider->image) }}" data-bs-holder-rendered="true">
                        </div>
                        @else
                            <div class="carousel-item">
                                <img class="d-block w-100" alt="" src="{{ asset($slider->image) }}" data-bs-holder-rendered="true">
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        
    </div>
@endsection

@section('discount')

    <div class="row mt-2">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
            <div class="btn btn-success btn-block">
                <marquee direction="left">
                    @foreach($coupons as $coupon)
                        <span class="mx-6 text-bold">Apply Code <b>{{ $coupon->code }}</b> To Get Taka <b>{{ $coupon->amount }}</b>
                            Discount. Minimum Order Tk. <b>{{ $coupon->order_amount }}</b>.</span>
                    @endforeach
                </marquee>

            </div>
        </div>
    </div>
@endsection

@section('after-slider')
    <div class="row mt-2 after-slider d-sm-none-max">
        <div class="col-3 col-lg-6 col-sm-12 col-md-6 col-xl-3 ">
            <div class="card " style="background-color: #0fa751">
                <div class="card-body text-center">
                    <span class="avatar avatar-xxl brround cover-image cover-image"
                          data-bs-image-src="{{ asset('/') }}website/assets/icons/ship.png"></span>
                    <h4 class="h4 mb-0 mt-1 text-center text-bold">Home Delivery</h4>
                    {{--<button class="card-text btn btn-warning mt-2">Click Here</button>--}}
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card " style="background-color: #ff9999">
                <div class="card-body text-center">
                    <span class="avatar avatar-xxl brround cover-image cover-image"
                          data-bs-image-src="{{ asset('/') }}website/assets/icons/operator.png"></span>
                    <h4 class="h4 mb-0 mt-1 text-center text-bold">Online Support</h4>
                    {{--<button class="card-text btn btn-success mt-2">Call Now</button>--}}
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card " style="background-color: #ffff66">
                <div class="card-body text-center">
                    <span class="avatar avatar-xxl brround cover-image cover-image"
                          data-bs-image-src="{{ asset('/') }}website/assets/icons/box.png"></span>
                    <h4 class="h4 mb-0 mt-1 text-center text-bold">Quality Products</h4>
                    {{--<button class="card-text btn btn-success mt-2">See Details</button>--}}
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
            <div class="card " style="background-color: #009999">
                <div class="card-body text-center">
                    <span class="avatar avatar-xxl brround cover-image cover-image"
                          data-bs-image-src="{{ asset('/') }}website/assets/icons/wrench.png"></span>
                    <h4 class="h4 mb-0 mt-1 text-center text-bold">Products Service</h4>
                    {{--<button class="card-text btn btn-success mt-2">See Details</button>--}}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('main-content')

    @if(count($products)>0)
        <div class="page-header">
            <div class="hover:bg-gray-100">
                <a href="" class="page-title text-black">
                    Featured Products
                </a>
            </div>
        </div>
        <div class="row row-cards">
            <div class="col-xl-12 col-lg-12">
                <div class="row products-main">
                    @foreach($products as $product)
                        <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-3 col-xxl product-each">
                                <div class="card item-card">
                                    <div class="product-grid6 card-body ">
                                        <div class="product-image6">
                                            <div class="">
                                                <img data-bs-target="#quick-view" data-bs-toggle="modal" class="quick-view img-fluid" src="{{ asset($product->image) }}" id="{{ $product->id }}"
                                                     style="height: 150px;cursor: pointer" alt="{{ $product->name }}">
                                                <div class="top-left"
                                                     style="position: absolute;top: 2px;left: 2px;">
                                                    <img src="{{ asset('/') }}website/assets/images/logo1.png" alt="" style="height:32px; width: 32px; border: 2px solid lightskyblue; border-radius: 50%">
                                                </div>
                                            </div>
                                            {{--<div class="icon-container">--}}
                                                {{--<ul class="icons">--}}
                                                    {{--<li>--}}
                                                        {{--<a href="#" class="quick-view" data-tip="Quick View">--}}
                                                            {{--<svg xmlns="http://www.w3.org/2000/svg" class="w-inner-icn" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M12,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C16,9.7908325,14.2091675,8,12,8z M12,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C15,13.6568604,13.6568604,15,12,15z M21.960022,11.8046875C19.9189453,6.9902344,16.1025391,4,12,4s-7.9189453,2.9902344-9.960022,7.8046875c-0.0537109,0.1246948-0.0537109,0.2659302,0,0.390625C4.0810547,17.0097656,7.8974609,20,12,20s7.9190063-2.9902344,9.960022-7.8046875C22.0137329,12.0706177,22.0137329,11.9293823,21.960022,11.8046875z M12,19c-3.6396484,0-7.0556641-2.6767578-8.9550781-7C4.9443359,7.6767578,8.3603516,5,12,5s7.0556641,2.6767578,8.9550781,7C19.0556641,16.3232422,15.6396484,19,12,19z"></path></svg>--}}
                                                        {{--</a>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                        </div>
                                        <div class="product-content w-100 p-3">
                                            <div class="mb-2">
                                                <h4 class="mb-1 text-normal">
                                                    <a href="{{ route('product.detail',[$product->id,$product->name]) }}" title="{{ $product->name }}">
                                                        {{ substr($product->name, 0,20).'...' }}
                                                    </a>
                                                </h4>
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
                                            <form action="{{ route('cart.add',$product->id) }}" method="post" >
                                            {{--<form id="cartAdd{{ $product->id }}">--}}
                                                @csrf
                                                <input type="hidden" name="qty" value="1">
                                                <button class="btn btn-success text-bold btn-block" data-id="{{ $product->id }}">Add To
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
    @endif

    @foreach($categories as $category)
        @if(count($category->products) > 0 )
            <div class="page-header">
                <div class="hover:bg-gray-100">
                    <a href="{{ route('product.category',['id'=>$category->id,'name'=>$category->name]) }}"
                       class="page-title text-black">{{ $category->name }}
                        {{--<i class="fa fa-angle-right"></i>--}}
                    </a>

                    {{--<a href="{{ route('product.category',['id'=>$category->id,'name'=>$category->name]) }}"--}}
                       {{--class="page-title text-black float-end">View All</i>--}}
                    {{--</a>--}}
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-xl-12 col-lg-12">
                    <div class="row products-main">
                        @foreach($category->products as $product)
                            @if($product->status == 1)
                                <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-3 col-xxl product-each">
                                    <div class="card item-card">
                                        <div class="product-grid6 card-body ">
                                            <div class="product-image6">
                                                <div class="">
                                                    <img data-bs-target="#quick-view" data-bs-toggle="modal" class="quick-view img-fluid" src="{{ asset($product->image) }}" id="{{ $product->id }}" style="height: 150px;cursor: pointer" alt="{{ $product->name }}">
                                                    <div class="top-left" style="position: absolute;top: 2px;left: 2px;">
                                                        <img src="{{ asset('/') }}website/assets/images/logo1.png" alt="" style="height:32px; width: 32px; border: 2px solid lightskyblue; border-radius: 50%">
                                                    </div>
                                                </div>
                                                {{--<div class="icon-container">--}}
                                                    {{--<ul class="icons">--}}
                                                        {{--<li>--}}
                                                            {{--<a href="product-details.html" data-tip="Quick View">--}}
                                                                {{--<svg xmlns="http://www.w3.org/2000/svg" class="w-inner-icn" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M12,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C16,9.7908325,14.2091675,8,12,8z M12,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C15,13.6568604,13.6568604,15,12,15z M21.960022,11.8046875C19.9189453,6.9902344,16.1025391,4,12,4s-7.9189453,2.9902344-9.960022,7.8046875c-0.0537109,0.1246948-0.0537109,0.2659302,0,0.390625C4.0810547,17.0097656,7.8974609,20,12,20s7.9190063-2.9902344,9.960022-7.8046875C22.0137329,12.0706177,22.0137329,11.9293823,21.960022,11.8046875z M12,19c-3.6396484,0-7.0556641-2.6767578-8.9550781-7C4.9443359,7.6767578,8.3603516,5,12,5s7.0556641,2.6767578,8.9550781,7C19.0556641,16.3232422,15.6396484,19,12,19z"></path></svg>--}}
                                                            {{--</a>--}}
                                                        {{--</li>--}}
                                                    {{--</ul>--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="product-content w-100 p-3">
                                                <div class="mb-2">
                                                    <h4 class="mb-1 text-normal">
                                                        <a href="{{ route('product.detail',[$product->id,$product->name]) }}" title="{{ $product->name }}">
                                                            {{ substr($product->name, 0,20).'...' }}
                                                        </a>
                                                    </h4>
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
                            @endif
                        @endforeach
                    </div>
                </div><!-- COL-END -->
            </div>
        @endif
    @endforeach

    <!-- Modal -->


@endsection
