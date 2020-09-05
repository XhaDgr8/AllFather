
@extends('layouts.contentLayoutMaster')

@section('page-vars')
    @php
        $active = "home"; $subActive = '';
        $title = "Welcome Home";
        $bread = [];
    @endphp
@endsection
@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                lazyLoad:true,
                items:1,
                autoplay: true,
                video:true,
                loop:true,
                animateOut: 'fadeOut',
                margin:250,
                onTranslate: function() {
                    owl.find('.video').click(function() {
                        this.pause();
                    });
                }
            });

            owl.on('mousewheel', '.owl-stage', function (e) {
                if (e.deltaY>0) {
                    owl.trigger('next.owl');
                } else {
                    owl.trigger('prev.owl');
                }
                e.preventDefault();
            });
        });
    </script>
@endsection
@section('content')
<div class="container">
    <div class="row mb-5 g-4">
        <!-- Welcome Box -->
        <div class="col-md-12 fadeInUp">
            <div style="height: 30rem" class="container hover-top anime cursor-pointer overflow-hidden position-relative rounded-lg shadow-md">

                <div class="owl-carousel owl-theme position-absolute w-100 h-100" style="top: 0;left: 0" >
                    <img data-src="{{asset('storage/sa/mainBg.jpg')}}" alt="Home Background Main" style="min-height: 30rem" class="img-fluid owl-lazy img-zoom w-100">
                    <img data-src="{{asset('storage/sa/mainBg1.jpg')}}" alt="Home Background Main" style="min-height: 30rem" class="img-fluid owl-lazy img-zoom w-100">
                    <img data-src="{{asset('storage/sa/mainBg2.jpg')}}" alt="Home Background Main" style="min-height: 30rem" class="img-fluid owl-lazy img-zoom w-100">
                </div>

                <div id="carouselExampleFade" class="carousel slide position-absolute w-100 h-100 overflow-hidden" style="top: 0;left: 0" data-ride="carousel">
                    <div class="carousel-inner">

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="position-absolute hover-top anime cursor-pointer w-100 h-100 pt-5 overflow-hidden d-flex flex-column justify-content-center"
                     style="top: 0;left: 0;z-index: 15;pointer-events: none">
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
        @if(auth()->user()->is_role('customer') != true)
            <!-- Blocks Start -->
                <!-- Orders -->
                @can('v_order_all')
                    <div class="col-md-3 fadeInUp">
                        <a href="/order" style="height: 15rem" class="container text-decoration-none btn btn-link border-0
                bg-white hover-top anime cursor-pointer position-relative rounded-lg shadow-md p-2">
                            <div class="container-fluid hover-top anime cursor-pointer row p-0">
                                <div class="col-auto">
                                    <div style="width: 3rem;height: 3rem"
                                         class="rounded-circle d-flex flex-row justify-content-center m-0 p-0 alert alert-warning">
                                        <x-icon i="userCog" class="m-0 my-auto p-0" h="1.5rem" w="1.5rem"/>
                                    </div>
                                </div>
                                <h1 class="font-weight-bold m-0 text-left text-dark col">
                                    {{count($orders)}}
                                </h1>
                                <h5 class="text-muted ml-2 col-12">
                                    Orders Gained
                                </h5>
                            </div>
                            <img src="{{asset('storage/sa/customersGained.jpg')}}" alt="Customers" class="img-fluid hover-top anime cursor-pointer">
                        </a>
                    </div>
                @endcan

                <!-- Workers -->
                @can('v_user_worker')
                    <div class="col-md-3 fadeInUp">
                        <a href="/customer/all" style="height: 15rem" class="container text-decoration-none btn btn-link border-0 bg-white hover-top anime cursor-pointer position-relative rounded-lg shadow-md p-2">
                            <div class="container-fluid hover-top anime cursor-pointer row p-0">
                                <div class="col-auto">
                                    <div style="width: 3rem;height: 3rem" class="rounded-circle m-0 p-0 d-flex flex-row justify-content-center alert alert-success">
                                        <x-icon i="breficase" class="m-0 my-auto p-0" h="1.5rem" w="1.5rem"/>
                                    </div>
                                </div>
                                <h1 class="font-weight-bold m-0 text-left text-dark col">
                                    {{$countWorkers}}
                                </h1>
                                <h5 class="text-muted ml-2 col-12">
                                    Online Worker'(s)
                                </h5>
                            </div>
                            <div style="margin-top: -.8rem" class="w-100 d-flex flex-row hover-top anime cursor-pointer justify-content-center">
                                <img src="{{asset('storage/sa/onlineWorker.jpg')}}" alt="Customers"
                                     class="img-fluid mx-auto" style="width: 10rem;">
                            </div>
                        </a>
                    </div>
                @endcan

                <!-- Sub Products -->
                @can('v_sub_product')
                    <div class="col-md-3 fadeInUp">
                        <a href="/sub-product" style="height: 15rem" class="container text-decoration-none btn btn-link border-0
                bg-white hover-top anime cursor-pointer position-relative rounded-lg shadow-md p-2">
                            <div class="container-fluid hover-top anime cursor-pointer row p-0">
                                <div class="col-auto">
                                    <div style="width: 3rem;height: 3rem"
                                         class="rounded-circle d-flex flex-row justify-content-center alert alert-primary m-0 p-0">
                                        <x-icon i="product" class="m-0 my-auto text-white p-0" h="1.5rem" w="1.5rem"/>
                                    </div>
                                </div>
                                <h1 class="font-weight-bold m-0 text-left text-dark col">
                                    {{count($subProducts)}}
                                </h1>
                                <h5 class="text-muted text-left mt-1 col-12">
                                    Available Sub Products
                                </h5>
                            </div>
                            <div style="margin-top: -.8rem" class="w-100 d-flex flex-row hover-top anime cursor-pointer justify-content-center">
                                <img src="{{asset('storage/sa/subproductBg.PNG')}}" alt="Customers"
                                     class="img-fluid mx-auto" style="width: 10rem;">
                            </div>
                        </a>
                    </div>
                @endcan

                <!-- Products -->
                @can('v_product')
                    <div class="col-md-3 fadeInUp">
                        <a href="/product" style="height: 15rem" class="container text-decoration-none btn btn-link border-0
                bg-white hover-top anime cursor-pointer position-relative rounded-lg shadow-md p-2">
                            <div class="container-fluid hover-top anime cursor-pointer row p-0">
                                <div class="col-auto">
                                    <div style="width: 3rem;height: 3rem" class="rounded-circle d-flex flex-row justify-content-center alert alert-info m-0 p-0">
                                        <x-icon i="productHunt" class="m-0 my-auto text-white p-0" h="1.5rem" w="1.5rem"/>
                                    </div>
                                </div>
                                <h1 class="font-weight-bold m-0 text-left text-dark col">
                                    {{count($products)}}
                                </h1>
                                <h5 class="text-muted mt-2 col-12">
                                    Available Products
                                </h5>
                            </div>
                            <div style="margin-top: -.8rem" class="w-100 d-flex flex-row hover-top anime cursor-pointer justify-content-center">
                                <img src="{{asset('storage/sa/productBg.PNG')}}" alt="Customers"
                                     class="img-fluid mx-auto" style="width: 10rem;">
                            </div>
                        </a>
                    </div>
                @endcan
            <!-- Blocks End -->

            <!-- Cards Start -->

                <!-- All Orders -->
                @can('v_order_all')
                    <div class="col-md-6 fadeInUp">
                        <div class="card border-0 rounded-lg overflow-hidden shadow-md">
                            <div class="card-header py-4 position-relative"
                                 style="background-image: url('{{asset("storage/sa/subProducts.jpg")}}');
                                     background-size: cover;
                                     background-repeat: no-repeat;
                                     background-position: top;">
                                <h1 class="text-muted display-4 m-0 font-weight-bold">
                                    All Orders
                                </h1>
                            </div>
                            <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: auto">
                                @if(count($orders) > 0)
                                    @foreach($orders as $order)
                                        <li class="list-group-item">
                                            <div class="d-inline">{{ $order->id }}</div>
                                            <div class="d-inline ml-4">{{ $order->createdBy->profile->user_name}}</div>
                                            @php
                                                if($order->status == 'pending'){
                                                    $status = 'warning';
                                                } elseif ($order->status == 'approved') {
                                                    $status = 'primary';
                                                } elseif ($order->status == 'shipped') {
                                                    $status = 'info';
                                                } elseif ($order->status == 'completed') {
                                                    $status = 'success';
                                                } elseif ($order->status == 'rejected') {
                                                    $status = 'danger';
                                                }
                                            @endphp
                                            <p class="d-inline ml-4 px-2 alert alert-{{ $status }} p-0 m-0">{{ $order->status }}</p>
                                            <div class="d-inline float-right">
                                                <a href="/order/{{$order->id}}" class="btn btn-link text-decoration-none
                                    btn-primary rounded-lg shadow-sm-primary">
                                                    <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">
                                        <div class="d-inline">No Orders Yet</div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endcan

                <!-- All Customers -->
                @can('v_user_customers')
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
                            <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: auto">
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
                @endcan

                <!-- All Products -->
                @can('v_product')
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
                            <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: auto">
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
                @endcan

                <!-- All Sub Products -->
                @can('v_sub_product')
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
                            <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: auto">
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
                @endcan

            <!-- Cards End -->
                <br><br>
            @endif
    </div>

    <!-- For Customers -->
    <div class="container my-5">
        {{-- Users Table --}}
        <h1 class="text-center">We are Continuously Adding <br> More Products Every Day</h1>
        <p class="text-center text-primary">
            Here You can place an order for the Product that you like.
        </p>
        <div class="row g-5">
            @foreach($products as $product)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="row text-muted bg-white c-it border border-primary anime shadow-md hover-up rounded-lg">
                        <div class="col-12 py-2" style="max-height: 15rem">
                            <x-sub-product-avatar class="img-fluid rounded-lg mx-auto mh-100"
                                                  :alt="$product->name" :for="$product->image" radius="" w="auto" h="auto"/>
                        </div>
                        <div class="col-auto">
                            <a href="/product/{{$product->id}}" class="btn btn-link float-left text-decoration-none
                                btn-outline-primary rounded-lg shadow-sm">
                                <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                            </a>
                        </div>
                        <div class="col"><h3 class="m-0 text-right font-weight-bold text-success">${{ $product->perUnit() }}</h3></div>
                        <div class="col-12 my-3"><h5 class="m-0">{{ $product->name }}</h5></div>
                        <div class="col-6"><p class="m-0">{{ $product->cat_number }}</p></div>
                        <div class="col-6">
                            <p class="m-0">
                                <strong>
                                    <span class="text-{{ $product->stock_quantity > 0 ? 'success' : 'danger' }}">{{ $product->stock_quantity > 0 ? 'In Stock' : 'not in stock' }}</span>
                                </strong>
                            </p>
                        </div>
                        @if (session()->has('product.id'))
                            @if(in_array($product->id, session('product.id')))
                                <div class="col-12 p-0 px-2 mt-3 alert alert-success">
                                    {{$product->name}} added to Order successfully
                                </div>
                            @endif
                        @endif
                        <div class="col-12 my-3">
                            <a href="/addToOrder/{{$product->id}}" class="btn btn-link float-left anime text-decoration-none btn-primary rounded-lg shadow-sm-primary">
                                <x-icon i="cartPlus" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                                Add To Order
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
