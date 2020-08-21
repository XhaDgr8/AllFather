@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "sub_products";
        $subActive = '';
        $title = 'Sub Products';
        $bread = ['Sub Products', 'active' => 'View Sub Product'];
    @endphp
@endsection
@section('content')
    <!-- app ecommerce details start -->
    <div class="bg-white border-primary border shadow-md rounded-lg">
        <div class="row mb-5 mt-2">
            @can('')
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-auto d-flex flex-row justify-content-start">
                                <p class="mt-3 m-0 mr-2">This Product Was Created On: <span class="text-primary font-weight-bold">{{$subProduct->created_at}}</span> BY </p>
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
            @endcan
            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                <div class="d-flex align-items-center justify-content-center pl-3">
                    <x-sub-product-avatar class="shadow-md rounded-lg" :alt="$subProduct->image" for="" radius="" w="100%" h="100%"/>
                </div>
            </div>
            <div class="col-12 col-md-6 pt-3">
                <div class="container">
                    <h3 class="text-primary text-decoration-underline font-weight-bold font-monospace">{{$subProduct->name}}</h3>
                    <p class="text-dark small">cat number: {{$subProduct->cat_number != "" ? $subProduct->cat_number : 'Cat Number'}}</p>
                    <div class="row pb-2 border-bottom">
                        <div class="col-auto pl-3 pr-2 border-right">
                            <h4 class="font-weight-normal m-0 text-primary">$ {{$subProduct->price_per_unit != "" ? $subProduct->price_per_unit : 'Price Per Unit'}}</h4>
                        </div>
                        <div class="col-auto px-2">
                            <h4 class="font-weight-normal m-0 text-muted">{{$subProduct->production_unit != "" ? $subProduct->production_unit : 'Production Unit'}}</h4>
                        </div>
                    </div>
                    <div class="pb-2 border-bottom">
                        <p class="mt-2 text-muted">
                            {{$subProduct->description != "" ? $subProduct->description : 'Description'}}
                        </p>
                        <p class="small font-weight-bold text-muted">
                            <x-icon i="glob" class="m-0 p-0" h="1rem" w="1rem"/>
                            {{$subProduct->country_of_origin != "" ? $subProduct->country_of_origin : 'Country of Origin'}}
                        </p>
                        <p class="small font-weight-bold text-muted">
                            <x-icon i="building" class="m-0 p-0" h="1rem" w="1rem"/>
                            {{$subProduct->facility_name != "" ? $subProduct->facility_name : 'Facility Name'}}
                        </p>
                    </div>
                    <div class="mt-2">
                        @if($subProduct->quantity != "")
                            @if(($subProduct->quantity != 0))
                                <p class="text-muted">Available - <span class="text-success">{{$subProduct->quantity}} In Stock</span></p>
                            @endif
                        @else
                            <p class="text-muted">Quantity</p>
                        @endif

                        <div class="row mt-2">
                            <div class="col-6">
                                <button type="button" class="btn btn-lg btn-primary shadow-md-primary">
                                    <x-icon i="dotCircle" class="m-0 mb-1 p-0" h="1rem" w="1rem"/> Add To Orders
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- app ecommerce details end -->
@endsection
