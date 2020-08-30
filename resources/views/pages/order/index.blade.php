@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "orders";
        $subActive = 'orders_all';
        $title = 'All Orders';
        $bread = ['Orders' ,'active' => 'All Orders'];
    @endphp
@endsection
@section('content')

    @can('v_order_all')
        <div class="container">
        {{-- Users Table --}}
        <h1 class="text-center">Orders Management</h1>
        <p class="text-center text-primary">
            Here You can see all Order and their status.
        </p>
        <div class="row">
            <div class="row py-3 text-center text-small text-muted">
                <div class="col-1"><p class="m-0">Order Id</p></div>
                <div class="col-2"><p class="m-0">Status</p></div>
                <div class="col-4"><p class="m-0">Shipping address</p></div>
                <div class="col-1"><p class="m-0">Total Price</p></div>
                <div class="col-2"><p class="m-0">Created by</p></div>
                <div class="col"><p class="m-0">Actions</p></div>
            </div>

            @foreach($orders as $order)
                <div class="row text-muted py-2 text-center bg-white c-it border border-primary anime my-2 shadow-md hover-up rounded-lg">
                    <div class="col-1">{{ $order->id }}</div>
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
                    <div class="col-2"><p class="alert alert-{{ $status }} p-0 m-0">{{ $order->status }}</p></div>
                    <div class="col-4">{{ $order->shipping_address }}</div>
                    <div class="col-1">{{ $order->id }}</div>
                    <div class="col-2">{{ $order->createdBy->profile->user_name }}</div>
                    <div class="col-auto mx-auto">
                        <a href="/order/{{$order->id}}" class="btn btn-link text-decoration-none
                                btn-primary rounded-lg shadow-sm-primary">
                            <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="col-12 my-5 d-flex flex-row justify-content-center">
                {{$orders->links()}}
            </div>
        </div>

    </div>
    @endcan

    @can('v_order_self')
        <div class="container">
        {{-- Users Table --}}
        <h1 class="text-center">Order Management</h1>
        <p class="text-center text-primary">
            Here You can see all order Created By You.
        </p>
        <div class="row">
            <div class="row py-3 text-center text-small text-muted">
                <div class="col-1"><p class="m-0">Order Id</p></div>
                <div class="col-2"><p class="m-0">Status</p></div>
                <div class="col-4"><p class="m-0">Shipping address</p></div>
                <div class="col-1"><p class="m-0">Total Price</p></div>
                <div class="col-2"><p class="m-0">Created by</p></div>
                <div class="col"><p class="m-0">Actions</p></div>
            </div>

            @foreach(auth()->user()->orders as $order)
                <div class="row text-muted py-2 text-center bg-white c-it border border-primary anime my-2 shadow-md hover-up rounded-lg">
                    <div class="col-1">{{ $order->id }}</div>
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
                    <div class="col-2"><p class="alert alert-{{ $status }} p-0 m-0">{{ $order->status }}</p></div>
                    <div class="col-4">{{ $order->shipping_address }}</div>
                    <div class="col-1">{{ $order->id }}</div>
                    <div class="col-2">{{ $order->createdBy->profile->user_name }}</div>
                    <div class="col-auto mx-auto">
                        <a href="/order/{{$order->id}}" class="btn btn-link text-decoration-none
                                btn-primary rounded-lg shadow-sm-primary">
                            <x-icon i="eye" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                        </a>
                    </div>
                </div>
            @endforeach
            <div class="col-12 my-5 d-flex flex-row justify-content-center">
                {{$orders->links()}}
            </div>
        </div>

    </div>
    @endcan
@endsection
