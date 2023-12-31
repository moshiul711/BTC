<div class="modal-body">
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
                                                    <img alt="{{ $product->name }}" src="{{ asset($product->image) }}">
                                                </li>
                                                @foreach($product->otherImages as $otherImage)
                                                    <li class="thumb" data-bs-slide-to="{{ $loop->iteration }}" data-bs-target="#Slider">
                                                        <img alt="{{ $product->name }}" src="{{ asset($otherImage->image) }}">
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
                                                <img alt="{{ $product->name }}" class="img img-thumbnail w-100 d-block " src="{{ asset($product->image) }}" style="height: 300px; width: 811px">
                                                <div class="top-left"
                                                     style="position: absolute;top: 2px;left: 2px;">
                                                    <img src="{{ asset('/') }}website/assets/images/logo1.png" alt="" style="height:32px; width: 32px; border: 2px solid lightskyblue; border-radius: 50%">
                                                </div>
                                            </div>
                                            @foreach($product->otherImages as $otherImage)
                                                <div class="carousel-item">
                                                    <img alt="img" class="img img-thumbnail w-100 d-block " src="{{ asset($otherImage->image) }}" style="height: 300px; width: 811px">
                                                    <div class="top-left"
                                                         style="position: absolute;top: 2px;left: 2px;">
                                                        <img src="{{ asset('/') }}website/assets/images/logo1.png" alt="" style="height:32px; width: 32px; border: 2px solid lightskyblue; border-radius: 50%">
                                                    </div>
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
                        <hr>
                        <p class="mb-1">
                            <span class="text-dark text-22">Offer Price : Tk. {{ $product->offer_price }}</span>
                            <span class="mx-2 text-muted text-decoration-line-through text-18">Tk. {{ $product->regular_price }}</span>
                            <span class="badge bg-red ms-2">({{ round($offer = (($product->regular_price - $product->offer_price )/$product->regular_price)*100) }}% Off)</span>
                        </p>

                        <div class="mt-5">
                            <form action="{{ route('cart.add') }}" method="post" id="cartForm">
                                @csrf
                                <input name="id" value="{{ $product->id }}" type="hidden">
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
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="mt-4 mb-4">
                            <h3 class="py-2"><u>{{ $product->name }}</u></h3>
                            <h4 class="mt-2">{{ $product->short_description }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#cartForm').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'POST',
            async: false,
            data: request,
            success: function (response) {
                if (response.message){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast'
                        },
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true
                    })
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                }
            }
        });
    });
</script>