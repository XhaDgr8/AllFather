@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "products";
        $subActive = 'products_create';
        $title = 'Edit Product';
        $bread = ['Products', 'active' => 'Edit Product'];
        $fields = [
            ['cat_number', $product->cat_number != "" ? $product->cat_number : 'Cat Number'],
            ['name', $product->name != "" ? $product->name : 'Name'],
            ['stock_quantity', $product->stock_quantity != "" ? $product->stock_quantity : 'Stock Quantity'],
            ['price_for_customer', $product->price_for_customer != "" ? $product->price_for_customer : 'Price For Customer'],
            ['price_for_admin',  $product->price_for_admin != "" ? $product->price_for_admin : 'Price For Admin'],
            ['other_costs',  $product->other_costs != "" ? $product->other_costs :'Other Costs'],
            ['category', $product->category != "" ? $product->category : 'Category'],
            ['key_words', $product->key_words != "" ? $product->key_words :'Key Word'],
            ['description', $product->description != "" ? $product->description : 'Description'],
            ];
    @endphp
@endsection
@section('content')
    <!-- app ecommerce details start -->
    <div class="bg-white mb-5 border-primary border shadow-md rounded-lg">
        <div class="row mb-5 mt-2">
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="col-auto d-flex flex-row justify-content-start">
                            <p class="mt-3 m-0 mr-2">This Product Was Created On:
                                <span class="text-primary font-weight-bold">{{$product->created_at}}</span> BY </p>
                            <div class="d-inline m-0 mt-2">
                                <button class="anime btn-sm btn my-1 px-2 rounded-pill btn-primary
                            shadow-sm-primary d-flex flex-row justify-content-around">
                                    <x-avatar class="shadow-sm mr-2" :for="$product->createdBy->profile->avatar" radius="100%" w="1.2rem" h="1.2rem"/>
                                    <h6 class="m-0">{{$product->createdBy->profile->user_name}}</h6>
                                </button>
                            </div>
                        </div>
                        @if($product->updated_by != '')
                            <div class="col-auto d-flex flex-row justify-content-start">
                                <p class="mt-3 m-0 mr-2">This Product Was Last Updated On: <span class="text-primary font-weight-bold">{{$product->updated_at}}</span> BY </p>
                                <div class="d-inline m-0 mt-2">
                                    <button class="anime btn-sm btn my-1 px-2 rounded-pill btn-primary
                            shadow-sm-primary d-flex flex-row justify-content-around">
                                        <x-avatar class="shadow-sm mr-2" :for="$product->updatedBy->profile->avatar" radius="100%" w="1.2rem" h="1.2rem"/>
                                        <h6 class="m-0">{{$product->updatedBy->profile->user_name}}</h6>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 pt-5">
                <div class="container pl-4 mb-3">
                    <sub-product-image url="productImage" :id="{{$product->id}}"></sub-product-image>
                </div>
                <div class="w-100 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                    <div class="d-flex align-items-center justify-content-center pl-2">
                        <x-sub-product-avatar class="shadow-lg my-2 rounded-lg"
                                              :alt="$product->name" :for="$product->image"
                                              radius="" w="100%" h="100%"/>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 pt-3">
                <div class="row mb-4">
                    <h3 class="text-primary col-6 text-decoration-underline">
                        {{$product->name}}
                    </h3>
                    <h3 class="text-primary col-6 text-decoration-underline">
                        Unit Prise: ${{$product->perUnit()}}
                    </h3>
                </div>
                <form action="/product/{{$product->id}}" method="post" class="row">
                    @csrf @method('PUT')
                    <div class="col-12">
                        @if($errors->any())
                            <p class="alert alert-danger">{{$errors->first()}}</p>
                        @endif
                        @if (session()->has('product.created'))
                            <div class="p-0 px-2 alert alert-success">
                                {{session('product.created')}}
                            </div>
                        @endif
                        @if (session()->has('product.updated'))
                            <div class="p-0 px-2 alert alert-success">
                                {{session('product.updated')}}
                            </div>
                        @endif
                        <input type="hidden" >
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
            <form action="/product/{{$product->id}}" method="post">
                @csrf @method("DELETE")
                <p class="text-danger small">Remember Deleting The Products means <br> That you delete all of the Relations that its associated with.</p>
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-lg shadow-sm">
                    <x-icon i="trash" class="m-0 p-0" h="1rem" w="1rem"/> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="container bg-white my-5 py-3 border-primary border shadow-md rounded-lg">
        <h1 class="text-center text-primary">Add Sub Products To this Main Product</h1>
    </div>

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6">
                <div class="bg-white border-primary border shadow-md rounded-lg py-3">
                    <h3 class="text-center text-primary">Available Products</h3>
                    <products-sub-products
                        :productid="{{$product->id}}"
                        assets="{{asset('storage/')}}"
                        assetselse="{{asset('storage/sa/subProducts.png')}}"
                        url="/productsSubProducts/{{$product->id}}"
                    />
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white border-primary border shadow-md rounded-lg px-2 py-3">
                    <h3 class="text-center text-primary">Add Sub Products</h3>
                    <div style="max-height: 25rem; overflow-y: scroll">
                        @foreach($subProducts as $subProduct)
                            <div class="row w-100 mx-auto rounded-lg p-2 shadow-md mb-3">
                                <div class="col-4">
                                    <x-sub-product-avatar class="shadow-sm"
                                                          :alt="$subProduct->name" :for="$subProduct->image"
                                                          radius="10%" w="8rem" h="8rem"/>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-8">
                                            <h4>{{ $subProduct->name }}</h4>
                                        </div>
                                        <div class="col-4">
                                            <attach-to-product :productid="{{$product->id}}" :subproductid="{{$subProduct->id}}"/>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <strong>Cat No: </strong>
                                                <span class="text-muted">{{ $subProduct->cat_number }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <strong>Category: </strong>
                                                <span class="text-muted">{{ $subProduct->category }}</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <strong>In Stock:
                                                    <span class="text-success">{{ $subProduct->stock_quantity }}</span>
                                                </strong>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <strong>Price Per Unit:
                                                    <span class="text-success">{{ $subProduct->price_per_unit }}</span>
                                                </strong>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <strong>Buying Unit:
                                                    <span class="text-info">{{ $subProduct->buying_unit }}</span>
                                                </strong>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p>
                                                <strong>Production Unit:
                                                    <span class="text-info">{{ $subProduct->production_unit }}</span>
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- app ecommerce details end -->
@endsection
<script>
    import AttachToProduct from "../../../js/components/AttachToProduct";
    export default {
        components: {AttachToProduct}
    }
</script>
