@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "products";
        $subActive = 'products_all';
        $title = 'All Products';
        $bread = ['Products' ,'active' => 'All Products'];
    @endphp
@endsection
@section('content')
    <div class="container">
        {{-- Users Table --}}
        <h1 class="text-center">Products Management</h1>
        <p class="text-center text-primary">
            Here You can see how is assigned to which user.
        </p>
        <div class="row">
            <div class="row py-3 text-center text-small text-muted">
                <div class="col-1"><p class="m-0">cat_number</p></div>
                <div class="col-1"><p class="m-0">image</p></div>
                <div class="col-2"><p class="m-0">Name</p></div>
                <div class="col-2"><p class="m-0">Category</p></div>
                <div class="col-1"><p class="m-0">Stock Quantity</p></div>
                <div class="col-1"><p class="m-0">Price Per Unit</p></div>
                <div class="col-2"><p class="m-0">Create by</p></div>
                <div class="col"><p class="m-0">Actions</p></div>
            </div>

            @foreach($products as $product)
                <div class="row text-muted py-2 text-center bg-white c-it border border-primary anime my-2 shadow-md hover-up rounded-lg">
                    <div class="col-1">{{ $product->cat_number }}</div>
                    <div class="col-1">
                        <x-sub-product-avatar class="shadow-sm" :alt="$product->name" :for="$product->image" radius="10%" w="4rem" h="4rem"/>
                    </div>
                    <div class="col-2">{{ $product->name }}</div>
                    <div class="col-2">{{ $product->category }}</div>
                    <div class="col-1">{{ $product->stock_quantity }}</div>
                    <div class="col-1">{{ $product->price_per_unit }}</div>
                    <div class="col-2">{{ $product->createdBy->profile->user_name }}</div>
                    <div class="col-auto">
                        <a href="/product/{{$product->id}}" class="btn btn-link float-left text-decoration-none
                                btn-primary rounded-lg shadow-sm-primary">
                            <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="/product/{{$product->id}}/edit" class="btn btn-link float-left text-decoration-none
                         btn-primary rounded-lg shadow-sm-primary">
                            <x-icon i="edit" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="col-12 my-5 d-flex flex-row justify-content-center">
                {{$products->links()}}
            </div>
        </div>

    </div>
@endsection
