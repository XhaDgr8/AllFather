@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "sub_products";
        $subActive = 'sub_products_create';
        $title = 'Account Settings';
        $bread = ['Sub Products', 'active' => 'Creat Sub Product'];
        $fields = [
            'cat_number' => 'Cat Number',
            'name' => 'Name',
            'country_of_origin' => 'Country of Origin',
            'facility_name' => 'Facility Name',
            'buying_unit' => 'Buying Unit',
            'price_per_unit' => 'Price Per Unit',
            'production_unit' => 'Production Unit',
            'production_price' => 'Production Price',
            'stock_quantity' => 'Stock Quantity',
            //'price_for_customer' => 'Price For Customer',
            //'price_for_admin' => 'Price For Admin',
            //'other_costs' => 'Other Costs',
            'category' => 'Category',
            'key_words' => 'Key Word',
            'description' => 'Description',
            ];
    @endphp
@endsection
@section('content')
    <!-- app ecommerce details start -->
    <div class="bg-white border-primary border shadow-md rounded-lg">
        <div class="row mb-5 mt-2">
            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                <div class="d-flex align-items-center justify-content-center pl-2">
                    <x-sub-product-avatar class="shadow-lg py-2 rounded-lg" alt="" for="" radius="" w="100%" h="100%"/>
                </div>
            </div>
            <div class="col-12 col-md-6 pt-3">
                <h3 class="text-primary text-decoration-underline">Create New Product</h3>
                <form action="{{route('sub-product.store')}}" method="post" class="row">
                    @csrf
                    <div class="col-12">
                        @if($errors->any())
                            <p class="alert alert-danger">{{$errors->first()}}</p>
                        @endif
                        @if (session()->has('subProduct.create'))
                            <div class="p-0 px-2 alert alert-success">
                                {{session('subProduct.create')}}
                            </div>
                        @endif
                            <input type="hidden" name="created_by" value="{{auth()->user()->id}}">
                            <input type="hidden" name="updated_by" value="">
                    </div>
                    @foreach($fields as $key => $field)
                        @if($key == 'description')
                            <div class="col-12">
                                <div class="form-group my-3">
                                    <div class="w-100 position-relative">
                                        <label class="small" for="{{$key}}" style="pointer-events: none">
                                            Description
                                        </label>
                                        <textarea id="{{$key}}"
                                                  class="form-control border @error($key) is-invalid @enderror"
                                                  name="{{$key}}"></textarea>
                                        @error($key)
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-6">
                                <x-text-input attr="" :name="$key" type="text" class="my-2"
                                              :label="$field" value="" />
                            </div>
                        @endif
                    @endforeach
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn anime btn-primary shadow-md-primary btn-block hovered">
                            <x-icon i="plus" class="mr-3" h="1.5rem" w="1rem"/> Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- app ecommerce details end -->
@endsection
