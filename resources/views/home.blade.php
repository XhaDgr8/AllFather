
@extends('layouts.contentLayoutMaster')

@section('page-vars')
    @php
        $active = ""; $subActive = '';
        $title = "Welcome Home";
        $bread = [];
    @endphp
@endsection

@section('content')
<div class="container">
    <div class="row g-4">
        <div class="col-md-6 fadeInUp">
            <div style="height: 15rem" class="container hover-top anime cursor-pointer overflow-hidden position-relative rounded-lg shadow-md">
                <div class="position-absolute w-100 h-100 overflow-hidden" style="top: 0;left: 0">
                    <img src="{{asset('storage/sa/mainBg.jpg')}}" alt="Home Background Main" class="img-fluid img-zoom w-100">
                </div>
                <div class="position-absolute hover-top anime cursor-pointer w-100 h-100 pt-5 overflow-hidden d-flex flex-column justify-content-center" style="top: 0;left: 0">
                    <h1 class="text-white mt-5 text-center font-weight-bold">
                        Welcome {{auth()->user()->profile->user_name}}
                    </h1>
                    <h4 class="text-center text-white font-weight-bold">
                        You are logged in! as
                        @foreach(auth()->user()->roles as $userRole)
                            <p class="badge bg-primary shadow-sm-primary">{{$userRole->label}}</p>
                        @endforeach
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 fadeInUp">
            <a href="/customer/all" style="height: 15rem" class="container text-decoration-none btn btn-link border-0
            bg-white hover-top anime cursor-pointer position-relative rounded-lg shadow-md p-2">
                <div class="container-fluid hover-top anime cursor-pointer row p-0">
                    <div class="col-auto">
                        <div style="width: 3rem;height: 3rem"
                             class="rounded-circle d-flex flex-row justify-content-center bg-warning">
                            <x-icon i="userCog" class="m-0 my-auto text-white p-0" h="1.5rem" w="1.5rem"/>
                        </div>
                    </div>
                    <h1 class="font-weight-bold m-0 text-left text-dark col">
                        {{count($customers)}}
                    </h1>
                    <h5 class="text-muted ml-2 mt-3 col-12">
                        Customers Gained
                    </h5>
                </div>
                <img src="{{asset('storage/sa/customersGained.jpg')}}" alt="Customers" class="img-fluid hover-top anime
                cursor-pointer">
            </a>
        </div>
        <div class="col-md-3 fadeInUp">
            <div href="/customer/all" style="height: 15rem" class="container bg-white hover-top anime cursor-pointer overflow-hidden rounded-lg shadow-md p-2">
                <div class="container-fluid g-0 row p-0 hover-top anime cursor-pointer">
                    <div class="col-3 pb-0">
                        <div style="width: 3rem;height: 3rem"
                             class="rounded-circle d-flex flex-row justify-content-center alert alert-success p-0">
                            <x-icon i="userCog" class="m-0 my-auto text-white p-0" h="1.5rem" w="1.5rem"/>
                        </div>
                    </div>
                    <h1 class="font-weight-bold p-0 m-0 col">
                        {{$countWorkers}}
                    </h1>
                    <h5 class="text-muted ml-2 p-0 m-0 col-12">
                        Online Worker'(s)
                    </h5>
                </div>
                <div style="margin-top: -.8rem" class="w-100 d-flex flex-row hover-top anime cursor-pointer justify-content-center">
                    <img src="{{asset('storage/sa/onlineWorker.png')}}" alt="Customers"
                         class="img-fluid mx-auto" style="width: 9rem;">
                </div>
            </div>
        </div>
        <div class="col-md-6 fadeInUp">
            <div class="card border-0 rounded-lg overflow-hidden shadow-md">
                <div class="card-header py-4 position-relative"
                style="background-image: url('{{asset("storage/sa/subProducts.jpg")}}');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: top;">
                    <h1 class="text-muted display-4 m-0 font-weight-bold">
                        All Products
                    </h1>
                </div>
                <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: scroll">
                    @if(count($products) > 0)
                        @foreach($products as $product)
                            <li class="list-group-item">
                                <div class="d-inline">
                                    <x-avatar class="shadow-sm mr-2" :for="$product->image" radius="100%" w="2.5rem" h="2.5rem"/>
                                </div>
                                <div class="d-inline">{{ $product->name }}</div>
                                <div class="d-inline float-right">
                                    <a href="/product/{{$product->id}}" class="btn btn-link text-decoration-none
                                btn-primary rounded-lg shadow-sm-primary">
                                        <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-6 fadeInUp">
            <div class="card border-0 rounded-lg overflow-hidden shadow-md">
                <div class="card-header py-4 position-relative"
                style="background-image: url('{{asset("storage/sa/subProducts.jpg")}}');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: top;">
                    <h1 class="text-muted display-4 m-0 font-weight-bold">
                        All Sub Products
                    </h1>
                </div>
                <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: scroll">
                    @foreach($subProducts as $subProduct)
                        <li class="list-group-item">
                            <div class="d-inline">
                                <x-avatar class="shadow-sm mr-2" :for="$product->image" radius="100%" w="2.5rem" h="2.5rem"/>
                            </div>
                            <div class="d-inline">{{ $subProduct->name }}</div>
                            <div class="d-inline float-right">
                                <a href="/sub-product/{{$subProduct->id}}" class="btn btn-link text-decoration-none
                                btn-primary rounded-lg shadow-sm-primary">
                                    <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="col-md-6 fadeInUp">
            <div class="card border-0 rounded-lg overflow-hidden shadow-md">
                <div class="card-header py-4 position-relative"
                     style="background-image: url('{{asset("storage/sa/subProducts.jpg")}}');
                         background-size: cover;
                         background-repeat: no-repeat;
                         background-position: top;">
                    <h1 class="text-muted display-4 m-0 font-weight-bold">
                        All Customers
                    </h1>
                </div>
                <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: scroll">
                    @foreach($customers as $customer)
                        <li class="list-group-item">
                            <div class="d-inline">
                                <x-avatar class="shadow-sm mr-2" :for="$customer->profile->avatar" radius="100%" w="2.5rem" h="2.5rem"/>
                            </div>
                            <div class="d-inline">{{ $customer->profile->user_name }}</div>
                            <div class="d-inline float-right">
                                <a href="/customers/{{$customer->id}}/edit" class="btn btn-link text-decoration-none
                                btn-primary rounded-lg shadow-sm-primary">
                                    <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
