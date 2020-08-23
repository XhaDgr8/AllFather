@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "sub_products";
        $subActive = 'sub_products_all';
        $title = 'All Sub Products';
        $bread = ['Sub Products' ,'active' => 'All Sub Products'];
        $fields = [
            'cat_number' => 'Cat Number',
            'name' => 'Name',
            'country_of_origin' => 'Country of Origin',
            'facility_name' => 'Facility Name',
            'buying_unit' => 'Buying Unit',
            'price_per_unit' => 'Price Per Unit',
            'production_unit' => 'Production Unit',
            'production_price' => 'Production Price',
            'quantity' => 'Quantity',
            'price_for_customer' => 'Price For Customer',
            'price_for_admin' => 'Price For Admin',
            'other_costs' => 'Other Costs',
            'category' => 'Category',
            'key_words' => 'Key Word',
            'description' => 'Description',
            ];
    @endphp
@endsection
@section('content')
    <div class="container">
        {{-- Users Table --}}
        <h1 class="text-center">Customers Management</h1>
        <p class="text-center text-primary">
            Here You can see how is assigned to which user.
        </p>
        <div class="row">
            <div class="row py-3 text-center text-small text-muted">
                <div class="col-1"><p class="m-0">cat_number</p></div>
                <div class="col-1"><p class="m-0">image</p></div>
                <div class="col-2"><p class="m-0">Name</p></div>
                <div class="col-2"><p class="m-0">Category</p></div>
                <div class="col-1"><p class="m-0">Quantity</p></div>
                <div class="col-1"><p class="m-0">Price Per Unit</p></div>
                <div class="col-2"><p class="m-0">Create by</p></div>
                <div class="col"><p class="m-0">Actions</p></div>
            </div>

            @foreach($subProducts as $subProduct)
                <div class="row text-muted py-2 text-center bg-white c-it border border-primary anime my-2 shadow-md hover-up rounded-lg">
                    <div class="col-1">{{ $subProduct->cat_number }}</div>
                    <div class="col-1">
                        <x-sub-product-avatar class="shadow-sm" :alt="$subProduct->name" :for="$subProduct->image" radius="10%" w="4rem" h="4rem"/>
                    </div>
                    <div class="col-2">{{ $subProduct->name }}</div>
                    <div class="col-2">{{ $subProduct->category }}</div>
                    <div class="col-1">{{ $subProduct->quantity }}</div>
                    <div class="col-1">{{ $subProduct->price_per_unit }}</div>
                    <div class="col-2">{{ $subProduct->createdBy->profile->user_name }}</div>
                    <div class="col-auto">
                        <a href="/sub-product/{{$subProduct->id}}" class="btn btn-link float-left text-decoration-none
                                btn-primary rounded-lg shadow-sm-primary">
                            <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="/sub-product/{{$subProduct->id}}/edit" class="btn btn-link float-left text-decoration-none
                         btn-primary rounded-lg shadow-sm-primary">
                            <x-icon i="edit" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
