@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "products";
        $subActive = 'products_all';
        $title = 'All Order';
        $bread = ['Orders' ,'active' => 'All Order'];
    @endphp
@endsection
@section('scripts')
    <script type="text/javascript">
        function myFunction(id, updatePrice, pricePerUnit){
            $('#'+id).change(function (){
                $value = $(this).val();
                $unit = $value *  pricePerUnit;
                $('#'+updatePrice).html($unit);
                $('.'+id).val($value);
                totaller();
            })
        }
        $(document).ready(function (){
            totaller();
            $('.linkWith').click(function (){
                $('#customer').val($(this).data('customer'));
                alert('linked');
            })
        });
        function totaller (){
            $total = 0;
            $( ".price" ).each(function( index ) {
                $price = parseInt($( this ).text());
                $total = $total + $price;
            });
            $('#totalPrice').html($total);
        }
    </script>
@endsection
@section('content')
    <form method="post" action="{{route('order.store')}}" class="container">
        @csrf
        <div class="row">
            <div style="height: 100vh;overflow-y: auto;" class="fadeInUp p-3 col-md-7">
                @foreach($products as $product)
                <div class="row my-3 bg-white anime hover-top shadow-md rounded-lg">
                    <a href="/product/{{$product->id}}" class="col-md-2 py-2 d-flex flex-column justify-content-center">
                        <x-sub-product-avatar class="card-img-top mx-auto rounded-lg"
                                              :alt="$product->name" :for="$product->image" radius="" w="6rem" h="6rem"/>
                    </a>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="row g-0 text-muted  small">
                                <h5 class="text-muted col-12">
                                    {{$product->name}}
                                </h5>
                                <div class="col-6">
                                    <p>
                                        <strong>Cat No: </strong>
                                        <span class="text-muted">{{ $product->cat_number }}</span>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        <strong>Price Per Unit:
                                            <span class="text-success">${{$product->perUnit()}}</span>
                                        </strong>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <p>
                                        <strong>
                                            <label class="form-label" for="{{$product->id}}">Quantity</label>
                                            <input min="0" onkeyup="myFunction({{$product->id}}, 'price_{{$product->id}}',{{$product->perUnit()}})" id="{{$product->id}}" type="number"
                                                   class="form-control border-primary inp" value="1"
                                                   pattern="/^[0-9]*$/" placeholder="auto">
                                        </strong>
                                    </p>
                                </div>

                                <div class="col-6">
                                    <p>
                                        <strong>
                                            <span class="text-{{ $product->stock_quantity > 0 ? 'success' : 'danger' }}">{{ $product->stock_quantity > 0 ? 'In Stock' : 'not in stock' }}</span>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col border-left d-flex flex-column justify-content-center">
                        <h5 class="text-primary text-center ">
                            $ <span class="price" id="price_{{$product->id}}">{{$product->perUnit()}}</span>
                            <input type="hidden" class="{{$product->id}}"
                                   name="{{$product->id}}" value="1">
                        </h5>
                        <a href="/removeFromOrder/{{$product->id}}" class="btn btn-block btn-link float-left
                        text-decoration-none text-dark rounded-lg">
                            <x-icon i="trash" class="m-0 text-danger p-0" h="1rem" w="1rem"/>
                            <span class="small">Remove From Order</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col fadeInUp">

                @can('c_order_customers')
                    <div class="container border-0 rounded-lg p-0 overflow-hidden shadow-md my-4">
                    <div class="card-header py-4 position-relative"
                         style="background-image: url('{{asset("storage/sa/subProducts.jpg")}}');
                             background-size: cover;
                             background-repeat: no-repeat;
                             background-position: top;">
                        <h5 class="text-muted m-0 font-weight-bold">
                            Assign To Customer
                        </h5>
                    </div>
                    <ul class="list-group list-group-flush" style="max-height: 15rem;overflow-y: auto">
                        @foreach($customers as $customer)
                            <li class="list-group-item">
                                <div class="d-inline">
                                    <x-avatar class="shadow-sm mr-2" :for="$customer->profile->avatar" radius="100%" w="2.5rem" h="2.5rem"/>
                                </div>
                                <div class="d-inline">{{ $customer->profile->user_name }}</div>
                                <div class="d-inline float-right">
                                    <button type="button" data-customer="{{$customer->profile->id}}"
                                            class="btn btn-link linkWith hovered anime text-decoration-none btn-primary rounded-lg shadow-sm-primary">
                                        <x-icon i="linkIt" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endcan

                <div class="container bg-white shadow-md py-3 border-primary rounded-lg">
                    <h5 class="text-muted">Order Details</h5>
                    <div class="separator my-3"></div>

                    <p class="my-3 text-muted">
                        <strong>
                            <label class="form-label" for="{{$product->id}}">Shipping Address</label>
                            <input type="text" class="form-control border-primary" name="shipping_address">
                            <input type="hidden" name="status" value="pending">
                        </strong>
                    </p>

                    <p class="text-muted small m-0">
                        If you need To attach any other details with the order you can do that here
                    </p>
                    <textarea class="form-control mb-4 border-primary"
                              name="description">
                    </textarea>

                    <h4 class="text-success mb-3">
                        Total Price: $<span id="totalPrice"></span>
                    </h4>
                    <input type="hidden" id="customer" name="created_by" value="{{auth()->user()->id}}">
                    <button class="btn btn-block border-0 btn-primary shadow-md-primary rounded-lg">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
