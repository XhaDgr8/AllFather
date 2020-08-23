@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "sub_products";
        $subActive = 'sub_products_create';
        $title = 'Account Settings';
        $bread = ['Sub Products', 'active' => 'Edit Sub Product'];
        $fields = [
            ['cat_number', $subProduct->cat_number != "" ? $subProduct->cat_number : 'Cat Number'],
            ['name', $subProduct->name != "" ? $subProduct->name : 'Name'],
            ['country_of_origin', $subProduct->country_of_origin != "" ? $subProduct->country_of_origin : 'Country of Origin'],
            ['facility_name', $subProduct->facility_name != "" ? $subProduct->facility_name : 'Facility Name'],
            ['buying_unit', $subProduct->buying_unit != "" ? $subProduct->buying_unit : 'Buying Unit'],
            ['price_per_unit', $subProduct->price_per_unit!= "" ? $subProduct->price_per_unit: 'Price Per Unit'],
            ['production_unit', $subProduct->production_unit != "" ? $subProduct->production_unit : 'Production Unit'],
            ['production_price', $subProduct->production_price != "" ? $subProduct->production_price : 'Production Price'],
            ['quantity', $subProduct->quantity != "" ? $subProduct->quantity : 'Quantity'],
            ['price_for_customer', $subProduct->price_for_customer != "" ? $subProduct->price_for_customer : 'Price For Customer'],
            ['price_for_admin',  $subProduct->price_for_admin != "" ? $subProduct->price_for_admin : 'Price For Admin'],
            ['other_costs',  $subProduct->other_costs != "" ? $subProduct->other_costs :'Other Costs'],
            ['category', $subProduct->category != "" ? $subProduct->category : 'Category'],
            ['key_words', $subProduct->key_words != "" ? $subProduct->key_words :'Key Word'],
            ['description', $subProduct->description != "" ? $subProduct->description : 'Description'],
            ];
    @endphp
@endsection
@section('content')
    <!-- app ecommerce details start -->
    <div class="bg-white border-primary border shadow-md rounded-lg">
        <div class="row mb-5 mt-2">
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="col-auto d-flex flex-row justify-content-start">
                            <p class="mt-3 m-0 mr-2">This Product Was Created On:
                                <span class="text-primary font-weight-bold">{{$subProduct->created_at}}</span> BY </p>
                            <div class="d-inline m-0 mt-2">
                                <button class="anime btn-sm btn my-1 px-2 rounded-pill btn-primary
                            shadow-sm-primary d-flex flex-row justify-content-around">
                                    <x-avatar class="shadow-sm mr-2" :for="$subProduct->createdBy->profile->avatar" radius="100%" w="1.2rem" h="1.2rem"/>
                                    <h6 class="m-0">{{$subProduct->createdBy->profile->user_name}}</h6>
                                </button>
                            </div>
                        </div>
                        @if($subProduct->updated_by != '')
                            <div class="col-auto d-flex flex-row justify-content-start">
                                <p class="mt-3 m-0 mr-2">This Product Was Last Updated On: <span class="text-primary font-weight-bold">{{$subProduct->updated_at}}</span> BY </p>
                                <div class="d-inline m-0 mt-2">
                                    <button class="anime btn-sm btn my-1 px-2 rounded-pill btn-primary
                            shadow-sm-primary d-flex flex-row justify-content-around">
                                        <x-avatar class="shadow-sm mr-2" :for="$subProduct->updatedBy->profile->avatar" radius="100%" w="1.2rem" h="1.2rem"/>
                                        <h6 class="m-0">{{$subProduct->updatedBy->profile->user_name}}</h6>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 pt-5">
                <div class="container pl-4 mb-3">
                    <sub-product-image :id="{{$subProduct->id}}"></sub-product-image>
                </div>
                <div class="w-100 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                    <div class="d-flex align-items-center justify-content-center pl-2">
                        <x-sub-product-avatar class="shadow-lg my-2 rounded-lg"
                                              :alt="$subProduct->name" :for="$subProduct->image" radius="" w="100%" h="100%"/>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 pt-3">
                <h3 class="text-primary text-decoration-underline">Edit {{$subProduct->name}}</h3>
                <form action="/sub-product/{{$subProduct->id}}" method="post" class="row">
                    @csrf @method('PUT')
                    <div class="col-12">
                        @if($errors->any())
                            <p class="alert alert-danger">{{$errors->first()}}</p>
                        @endif
                        @if (session()->has('subProduct.updated'))
                            <div class="p-0 px-2 alert alert-success">
                                {{session('subProduct.updated')}}
                            </div>
                        @endif
                        <input type="hidden" name="created_by" value="">
                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">
                    </div>

                    @foreach($fields as $field)
                        @if($field[0] == 'description')
                            <div class="col-12">
                                <div class="form-group my-3">
                                    <div class="w-100 position-relative">
                                    <label class="small" for="{{$field[0]}}" style="pointer-events: none">
                                        Description
                                    </label>
                                    <textarea id="{{$field[0]}}"
                                              class="form-control border border-primary @error($field[0]) is-invalid @enderror"
                                              name="{{$field[0]}}">{{$field[1]}}</textarea>
                                        @error($field[0])
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-6 my-2">
                                <x-text-input attr="" :name="$field[0]" type="text" class=""
                                              :label="$field[1]" value="" />
                                <label class="small float-right" for="{{$field[0]}}" style="pointer-events: none">
                                    {{$field[0]}}
                                </label>
                            </div>
                        @endif
                    @endforeach
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn anime btn-primary shadow-md-primary btn-block hovered">
                            <x-icon i="edit" class="mr-2 mb-1" h="1rem" w="1.5rem"/> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-1 p-4">
            <form action="/sub-product/{{$subProduct->id}}" method="post">
                @csrf @method("DELETE")
                <p class="text-danger small">Remember Deleting The Products means <br> That you delete all of the Relations that its associated with.</p>
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-lg shadow-sm">
                    <x-icon i="trash" class="m-0 p-0" h="1rem" w="1rem"/> Delete
                </button>
            </form>
        </div>
    </div>
    <!-- app ecommerce details end -->
@endsection
