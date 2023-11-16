@extends('layouts.app')

@section('main-content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage</li>
            </ol>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">All Products</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                            <thead class="text-center">
                            <tr>
                                <th class="wd-15p border-bottom-0"></th>
                                <th class="wd-15p border-bottom-0">Category</th>
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-15p border-bottom-0">Offer</th>
                                <th class="wd-15p border-bottom-0">Regular</th>
                                <th class="wd-20p border-bottom-0">Stock</th>
                                <th class="wd-20p border-bottom-0">Sales</th>
                                <th class="wd-25p border-bottom-0">Action</th>
                            </tr>
                            </thead>
                            <tbody class="text-justify">
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset($product->image) }}" height="40" width="60" alt="">
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ substr($product->name,0,20) }}...</td>
                                    <td>{{ $product->offer_price }}</td>
                                    <td>{{ $product->regular_price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->sales_count }}</td>

                                    <td>
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-sm btn-info" title="Product Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        {{--<form action="{{route('product.destroy',$product->id)}}" id="deleteForm{{$product->id}}" method="POST">--}}
                                            {{--@csrf--}}
                                            {{--@method('DELETE')--}}
                                            {{--<button type="submit" data-id="{{$product->id}}"  class="btn btn-danger btn-sm delete-btn">--}}
                                                {{--<i class="fa fa-trash"></i>--}}
                                            {{--</button>--}}
                                        {{--</form>--}}



                                        <button type="button"  class="btn btn-sm btn-danger delete-btn" value="{{ $product->id }}" ><i class="fas fa fa-trash"></i></button>
                                        {{--<div class="modal  fade" id="productDelete" tabindex="-1" role="dialog">--}}
                                            {{--<div class="modal-dialog modal-sm" role="document">--}}
                                                {{--<div class="modal-content">--}}
                                                    {{--<div class="modal-header">--}}
                                                        {{--<h5 class="modal-title">Product Delete</h5>--}}
                                                        {{--<button  class="btn-close" data-bs-dismiss="modal" aria-label="Close">--}}
                                                            {{--<span aria-hidden="true">×</span>--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="modal-body">--}}
                                                        {{--<p>Are You sure to delete this product?</p>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="modal-footer">--}}
                                                        {{--<button  class="btn btn-success" data-bs-dismiss="modal">Close</button>--}}
                                                        {{--<form action="{{ route('product.destroy',$product->id) }}" method="post" id="deleteForm{{ $product->id }}">--}}
                                                            {{--@csrf--}}
                                                            {{--@method('DELETE')--}}
                                                            {{--<button type="submit" data-id="{{ $product->id }}" class="btn btn-danger delete-btn">Delete</button>--}}
                                                        {{--</form>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </td>
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