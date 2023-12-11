@extends('website.master')

@section('title')
    {{ $product->name }}
@endsection

@section('main-content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">{{ $product->category->name }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <!-- ROW-1 OPEN -->
    <div class="row">
        <!-- COL-OPEN -->
        <div class="col-lg-12 col-md-12">
            <div class="card productdesc">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class=" col-xl-6 col-lg-12 col-md-12">
                            <div class="row h-100">
                                <div class="col-xl-2">
                                    <div class="clearfix carousel-slider h-100">
                                        <div class="carousel slide h-100" data-bs-interval="t" id="thumbcarousel">
                                            <div class="carousel-inner h-100">
                                                <ul class="carousel-item active d-flex h-100">
                                                    <li class="thumb active" data-bs-slide-to="0" data-bs-target="#Slider">
                                                        <img alt="img" src="{{ asset($product->image) }}">
                                                    </li>
                                                    @foreach($product->otherImages as $otherImage)
                                                    <li class="thumb" data-bs-slide-to="{{ $loop->iteration }}" data-bs-target="#Slider">
                                                        <img alt="img" src="{{ asset($otherImage->image) }}">
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-10">
                                    <div class="product-carousel h-100">
                                        <div class="carousel slide h-100" data-bs-ride="false" id="Slider">
                                            <div class="carousel-inner h-100">
                                                <div class="carousel-item active">
                                                    <img alt="img" class="img img-thumbnail w-100 d-block " src="{{ asset($product->image) }}" style="height: 300px; width: 811px">
                                                    <div class="top-left" style="position: absolute;top: 2px;left: 2px;"><button class="btn btn-sm btn-danger-gradient">BTC</button></div>
                                                </div>
                                                @foreach($product->otherImages as $otherImage)
                                                <div class="carousel-item">
                                                    <img alt="img" class="img img-thumbnail w-100 d-block " src="{{ asset($otherImage->image) }}" style="height: 300px; width: 811px">
                                                    <div class="top-left" style="position: absolute;top: 2px;left: 2px;"><button class="btn btn-sm btn-danger-gradient">BTC</button></div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-12 col-md-12">
                            <h3 class="mb-2 mt-xl-0 mt-4">{{ $product->name }}</h3>
                            <div class="text-warning rating-container d-sm-flex">
                                <div class="ms-2">
                                    <span>
                                        <a style="color: #00cc00; font-size: 18px"><i class="fa fa-line-chart"></i> {{ $product->hit_count }} View(s)</a>
                                        <a class="px-5" style="color: darkred; font-size: 18px"><i class="fa fa-bar-chart-o"></i> {{ count($product->reviews) }} Review(s)</a>
                                        @if($product->stock > 0)
                                        <a class="px-1" style="color: #008069; font-size: 18px"><i class=" fa fa-cubes"></i> In Stock</a>
                                        @else<a class="px-1 text-danger" style="color: #008069; font-size: 18px"><i class=" fa fa-cubes"></i>Out of Stock</a>
                                            @endif
                                    </span>
                                </div>
                            </div>
                            <p class="mb-0 text-18 mt-5">Price</p>
                            <p class="mb-1">
                                <span class="text-dark text-22">Tk. {{ $product->offer_price }}</span>
                                <span class="mx-2 text-muted text-decoration-line-through text-18">Tk. {{ $product->regular_price }}</span>
                                <span class="badge bg-red ms-2">({{ round($offer = (($product->regular_price - $product->offer_price )/$product->regular_price)*100) }}% Off)</span>
                            </p>

                            <div class="mt-5">
                                <form action="{{ route('cart.add',$product->id) }}" method="post">
                                    @csrf
                                    <div class="row">

                                        @if($product->stock > 0)
                                            <div class="col-md-6 form-group">
                                                <input type="number" class="form-control" required placeholder="Enter Product Quantity" value="1" min="1" max="{{ $product->stock }}"  name="qty" id="quantity">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <input type="submit" class="form-control btn btn-success text-bold" value="ADD TO CART"  name="submit">
                                            </div>
                                        @else
                                            <div class="col-md-6 form-group">
                                                <input type="number" class="form-control" required placeholder="Enter Product Quantity" value="1" min="1" max="{{ $product->stock }}"  name="qty">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                {{--<input id="swal-timer" type="submit" class="form-control btn btn-success text-bold" value="ADD TO CART"  name="submit">--}}
                                                <a href="javascript:void(0)" id="swal-timer" class="form-control btn btn-outline-success text-bold">Add To Cart</a>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>

                            {{--<div class="card">--}}
                                {{--<div class="card-header border-bottom">--}}
                                    {{--<h5 class="card-title">Additional Offers</h5>--}}
                                {{--</div>--}}
                                {{--<div class="card-body">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-md-2 text-center border br-7 px-4 m-1">--}}
                                            {{--<svg xmlns="http://www.w3.org/2000/svg" class="w-icn" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M21.5,5h-4C17.223877,5,17,5.223877,17,5.5S17.223877,6,17.5,6H21v12H10.7069702l1.6464844-1.6464844c0.1871948-0.1937866,0.1871948-0.5009766,0-0.6947021c-0.1918335-0.1986694-0.5083618-0.2041626-0.7069702-0.0122681l-2.5,2.5c-0.000061,0-0.0001221,0.000061-0.0001221,0.0001221c-0.1951904,0.1951904-0.1951294,0.5117188,0.0001221,0.7068481l2.5,2.5C11.7401123,21.4474487,11.8673706,21.5001831,12,21.5c0.1325684,0,0.2597046-0.0526733,0.3533936-0.1464233c0.1953125-0.1952515,0.1953125-0.5118408,0.0001221-0.7070923L10.7069702,19h10.7936401C21.7765503,18.9998169,22.0001831,18.776001,22,18.5V5.4993896C21.9998169,5.2234497,21.776001,4.9998169,21.5,5z M5.5,18H3V6h10.2930298l-1.6465454,1.6464844c-0.09375,0.09375-0.1464233,0.2208862-0.1464233,0.3534546C11.5,8.276062,11.723877,8.499939,12,8.5c0.1326294,0.0001221,0.2598267-0.0525513,0.3534546-0.1464844l2.5-2.5c0.000061-0.000061,0.0001221-0.000061,0.0001831-0.0001221c0.1951294-0.1952515,0.1950684-0.5117188-0.0001831-0.7068481l-2.5-2.5c-0.1937256-0.1871338-0.5009155-0.1871338-0.6947021,0c-0.1986084,0.1918335-0.2041016,0.5083618-0.0122681,0.7069702L13.2930298,5H2.4993896C2.2234497,5.0001831,1.9998169,5.223999,2,5.5v13.0005493C2.0001831,18.7765503,2.223999,19.0001831,2.5,19h3C5.776123,19,6,18.776123,6,18.5S5.776123,18,5.5,18z"/></svg>--}}
                                            {{--<p class="mb-0 mt-2">{{ $product->replacement }} <br> Replacement</p>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-2 text-center border br-7 px-4 m-1">--}}
                                            {{--<svg xmlns="http://www.w3.org/2000/svg" class="w-icn" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M14.5,11.5h-2v-2C12.5,9.2,12.3,9,12,9s-0.5,0.2-0.5,0.5v2h-2C9.2,11.5,9,11.7,9,12s0.2,0.5,0.5,0.5h2v2c0,0,0,0,0,0c0,0.3,0.2,0.5,0.5,0.5c0,0,0,0,0,0c0.3,0,0.5-0.2,0.5-0.5v-2h2c0.3,0,0.5-0.2,0.5-0.5S14.8,11.5,14.5,11.5z M20,3.8c-0.1-0.3-0.3-0.4-0.6-0.4c-2.5,0.5-5,0-7.1-1.5c-0.2-0.1-0.4-0.1-0.6,0c-2.1,1.4-4.6,2-7.1,1.5c0,0-0.1,0-0.1,0C4.2,3.4,4,3.6,4,3.9v8c0,2.9,1.4,5.7,3.8,7.4l3.9,2.8c0.1,0.1,0.2,0.1,0.3,0.1c0.1,0,0.2,0,0.3-0.1l3.9-2.8c2.4-1.7,3.8-4.5,3.8-7.4v-8C20,3.8,20,3.8,20,3.8z M19,11.9c0,2.6-1.3,5.1-3.4,6.6L12,21.1l-3.6-2.6c-2.1-1.5-3.4-4-3.4-6.6V4.5c2.4,0.4,4.9-0.2,7-1.5c2.1,1.3,4.6,1.9,7,1.5V11.9z"/></svg>--}}
                                            {{--<p class="mb-0 mt-2">{{ $product->service }} <br> Warranty</p>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="mt-4 mb-4">
                                <h3 class="py-2"><u>{{ $product->name }}</u></h3>
                                <h4 class="mt-2">{{ $product->short_description }}</h4>
                            </div>
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading border-bottom-0">
                                    <div class="tabs-menu">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs ">
                                            <li>
                                                <a class="btn active me-2 my-sm-0 my-1 text-body text-bold" data-bs-toggle="tab" href="#tab1">Specifications</a>
                                            </li>
                                            <li>
                                                <a class="btn me-2 my-sm-0 my-1 text-body text-bold" data-bs-toggle="tab" href="#tab2">Description</a>
                                            </li>
                                            <li>
                                                <a class="btn text-body my-sm-0 my-1 text-bold" data-bs-toggle="tab" href="#tab3">Reviews</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <h4 class="mb-5 mt-3">General</h4>
                                            <ul class="list-unstyled mb-0">
                                                <li class="row">
                                                    <div class="col-sm-3 text-muted">
                                                        Brand
                                                    </div>
                                                    <div class="col-sm-3">
                                                        {{ $product->brand->name }}
                                                    </div>
                                                </li>
                                                <li class=" row">
                                                    <div class="col-sm-3 text-muted">
                                                        Model Number
                                                    </div>
                                                    <div class="col-sm-3">
                                                        {{ $product->model }}
                                                    </div>
                                                </li>
                                                <li class="p-b-20 row">
                                                    <div class="col-sm-3 text-muted">
                                                        Code
                                                    </div>
                                                    <div class="col-sm-3">
                                                        {{ $product->code }}
                                                    </div>
                                                </li>
                                                <li class="p-b-20 row">
                                                    <div class="col-sm-3 text-muted">
                                                        Replacement
                                                    </div>
                                                    <div class="col-sm-3">
                                                        {{ $product->replacement }} Replace Guarantee
                                                    </div>
                                                </li>

                                                <li class="p-b-20 row">
                                                    <div class="col-sm-3 text-muted">
                                                        Service
                                                    </div>
                                                    <div class="col-sm-3">
                                                        {{ $product->service }} Service Warranty
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            {!! $product->long_description !!}
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <ul class="comment-section-main">
                                                @foreach($product->reviews as $review)
                                                <li>
                                                    <div class="media mb-5 cnsl">
                                                        <div class=" me-3">
                                                            <a href="javascript:void(0)">
                                                                <img alt="64x64" class="media-object rounded-circle thumb-sm" src="{{ asset($review->customer->image) }}">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="name-time-container d-flex">
                                                                <h5 class="mt-0 mb-0 me-2">{{ $review->customer->first_name.' '.$review->customer->last_name }}</h5><svg class="mx-2 me-1" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M11.999939,6.5c-0.276123,0-0.5,0.223877-0.5,0.5v4.6914062l-2.7059937,1.3623047c-0.168457,0.0848999-0.2747803,0.2573853-0.2749634,0.4460449C8.5187988,13.7758789,8.7424927,13.9998169,9.0185547,14c0.078064,0.0003662,0.1550903-0.0180664,0.2245483-0.0537109l2.9814453-1.5C12.3933105,12.3615112,12.4998169,12.1888428,12.499939,12V7C12.499939,6.723877,12.276123,6.5,11.999939,6.5z M12,2C6.4771729,2,2,6.4771729,2,12s4.4771729,10,10,10c5.5201416-0.0064697,9.9935303-4.4798584,10-10C22,6.4771729,17.5228271,2,12,2z M12,21c-4.9705811,0-9-4.0294189-9-9s4.0294189-9,9-9c4.9683228,0.0054321,8.9945679,4.0316772,9,9C21,16.9705811,16.9705811,21,12,21z"></path></svg> <span class="time-main text-muted">{{ $review->updated_at }}</span>
                                                            </div>
                                                            <div class="text-warning mb-0">
                                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <div class="comment-main-action d-flex">
                                                                <p class="font-13 text-muted mb-0 comment-main">{{ $review->review }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @if(Session::get('customer_id'))
                                                <div class="row mt-2">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header border-bottom">
                                                                <h5 class="card-title mb-3">Review</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <form action="{{ route('product.review',$product->id) }}" class="form-horizontal m-t-20" method="post">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <div class="col-xs-12">
                                                                            <textarea class="form-control" rows="5" name="review" placeholder="Share Your Experience..."></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div >
                                                                        <button style="float: right" class="btn btn-success-gradient" type="submit">Post Review</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->

    </div>

    <!-- ROW-2 OPEN -->
    <div class="row ">
        <div class="col-md-12">
            <div class="title">
                <h3>
                    Related Products
                </h3>
            </div>
            <div class="row">
                @foreach($relatedProducts as $product)
                    @if($product->status == 1)
                        <div class="col-6 col-md-6 col-sm-6 col-lg-6 col-xl-3 product-each">
                            <div class="card item-card">
                                <div class="product-grid6 card-body">
                                    <div class="product-image6">
                                        <a href="{{ route('product.detail',[$product->id,$product->name]) }}"
                                           class="img-container" target="_blank">
                                            <img class="img-fluid" src="{{ asset($product->image) }}"
                                                 style="height: 150px" alt="img">
                                            <div class="top-left"
                                                 style="position: absolute;top: 8px;left: 16px; color:red">BTC
                                            </div>
                                        </a>
                                        <div class="icon-container">
                                            <ul class="icons">
                                                <li>
                                                    <a href="{{ route('product.detail',[$product->id,$product->name]) }}"
                                                       target="_blank" data-tip="Quick View">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="w-inner-icn"
                                                             enable-background="new 0 0 24 24"
                                                             viewBox="0 0 24 24">
                                                            <path d="M12,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C16,9.7908325,14.2091675,8,12,8z M12,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C15,13.6568604,13.6568604,15,12,15z M21.960022,11.8046875C19.9189453,6.9902344,16.1025391,4,12,4s-7.9189453,2.9902344-9.960022,7.8046875c-0.0537109,0.1246948-0.0537109,0.2659302,0,0.390625C4.0810547,17.0097656,7.8974609,20,12,20s7.9190063-2.9902344,9.960022-7.8046875C22.0137329,12.0706177,22.0137329,11.9293823,21.960022,11.8046875z M12,19c-3.6396484,0-7.0556641-2.6767578-8.9550781-7C4.9443359,7.6767578,8.3603516,5,12,5s7.0556641,2.6767578,8.9550781,7C19.0556641,16.3232422,15.6396484,19,12,19z"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                                {{--<li>--}}
                                                {{--<a href="{{ route('cart.add',$product->id) }}" data-tip="Add to Cart" target="_blank">--}}
                                                {{--<svg xmlns="http://www.w3.org/2000/svg" class="w-inner-icn" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M9,18c-1.1045532,0-2,0.8954468-2,2s0.8954468,2,2,2c1.1040039-0.0014038,1.9985962-0.8959961,2-2C11,18.8954468,10.1045532,18,9,18z M9,21c-0.5523071,0-1-0.4476929-1-1s0.4476929-1,1-1c0.552124,0.0003662,0.9996338,0.447876,1,1C10,20.5523071,9.5523071,21,9,21z M17,18c-1.1045532,0-2,0.8954468-2,2s0.8954468,2,2,2c1.1040039-0.0014038,1.9985962-0.8959961,2-2C19,18.8954468,18.1045532,18,17,18z M17,21c-0.5523071,0-1-0.4476929-1-1s0.4476929-1,1-1c0.552124,0.0003662,0.9996338,0.447876,1,1C18,20.5523071,17.5523071,21,17,21z M19.4985352,12.0502319l1.9848633-7.4213257c0.0111694-0.0419312,0.0167847-0.085083,0.0167847-0.128479C21.5002441,4.2241211,21.2763062,4.000061,21,4H5.9198608L5.4835205,2.371582C5.4249268,2.1530151,5.2268677,2.0009766,5.0005493,2.0009766H3.5048218C3.5031128,2.0009766,3.501709,2,3.5,2C3.223877,2,3,2.223877,3,2.5S3.223877,3,3.5,3v0.0009766L4.6162109,3l2.579834,9.6288452C7.2546387,12.8477783,7.453064,13,7.6796875,13H11h6.8603516H19c0.8284302,0,1.5,0.6715698,1.5,1.5S19.8284302,16,19,16H5c-0.276123,0-0.5,0.223877-0.5,0.5S4.723877,17,5,17h14c1.3807373,0,2.5-1.1192627,2.5-2.5C21.5,13.2900391,20.6403809,12.2813721,19.4985352,12.0502319z M18.4761963,12h-0.6158447H11H8.0634766L6.1878052,5h14.1608276L18.4761963,12z"></path></svg>--}}
                                                {{--</a>--}}
                                                {{--</li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content w-100 p-3">
                                        <div class="mb-2">
                                            <h4 class="mb-1 text-normal"><a
                                                        href="{{ route('product.detail',[$product->id,$product->name]) }}"
                                                        target="_blank"
                                                        title="{{ $product->name }}">{{ substr($product->name, 0,25) }}  </a>
                                            </h4>
                                            <p class="mb-0 text-muted text-start">{{ $product->brand->name }}</p>
                                        </div>
                                        <p class="mb-2 text-warning">
                                    <span>
                                        <del class="text-18  ms-1"
                                             style="color: black">Tk. {{ $product->regular_price }}</del>
                                    </span>

                                            <span class="badge bg-red ms-2" style="float: right">{{ round($offer = (($product->regular_price - $product->offer_price )/$product->regular_price)*100) }}
                                                % Off</span>
                                        </p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0">
                                                <span class="text-22 text-bold">Tk. {{ $product->offer_price }}</span>
                                            </p>
                                            @if($product->stock > 0)
                                                <p class="mb-0 text-success-darkest">Available</p>
                                            @else
                                                <p class="mb-0 text-secondary">Out of Stock</p>
                                            @endif

                                        </div>
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
        </div>
    </div>
@endsection
