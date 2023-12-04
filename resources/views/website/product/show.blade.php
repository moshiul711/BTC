@extends('website.master')

@section('title')
    Bangladesh Technology Company
@endsection

{{----}}

@section('discount')

    <div class="row mt-2">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xl-12">
            <div class="btn btn-success btn-block">
                <marquee direction="left">
                    @foreach($coupons as $coupon)
                        <span class="mx-6">Apply Code <b>{{ $coupon->code }}</b> To Get Taka {{ $coupon->amount }}
                            Discount. Minimum Order Tk. <b>{{ $coupon->order_amount }}</b>.</span>
                    @endforeach
                </marquee>

            </div>
        </div>
    </div>
@endsection

{{----}}

@section('main-content')
    <div class="row row-cards mt-5">
        <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12">
            <h4 class="text-lg-bold py-2">Search Result For {{ $_GET['search'] }}...</h4>
        </div>
        <div class="col-xl-12 col-lg-12">
                    <div class="row products-main">
                        @foreach($products as $product)
                            @if($product->status == 1)
                                <div class="col-12 col-md-6 col-sm-6 col-lg-6 col-xl-3 product-each">
                                    <div class="card item-card">
                                        <div class="product-grid6 card-body">
                                            <div class="product-image6">
                                                <a href="{{ route('product.detail',[$product->id,$product->name]) }}"
                                                   class="img-container" target="_blank">
                                                    <img class="img-fluid" src="{{ asset($product->image) }}"
                                                         style="height: 150px" alt="img">
                                                    <div class="top-left" style="position: absolute;top: 2px;left: 2px;"><button class="btn btn-sm btn-danger-gradient">BTC</button></div>
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
                                        @if($product->stock > 0)
                                            <form id="cartAdd" action="{{ route('cart.add',$product->id) }}"
                                                  method="post">
                                                @csrf
                                                <input type="hidden" name="qty" value="1">
                                                <button class="btn btn-outline-success text-bold btn-block">Add To
                                                    Cart
                                                </button>
                                            </form>
                                        @else
                                            <button id="swal-timer" class="btn btn-outline-success text-bold btn-block">
                                                Add To Cart
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div><!-- COL-END -->
    </div>
@endsection
