@extends('layouts.contentLayoutMaster')

@section('page-vars')
    @php
        $active = "customers";
        $subActive = 'customer_all';
        $title = "All Customers";
        $bread = ['Admin', 'Pages' ,'active' => 'All Customers'];
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
                <div class="col-1"><p class="m-0">avatar</p></div>
                <div class="col-1"><p class="m-0">User Name</p></div>
                <div class="col-3"><p class="m-0">User Email</p></div>
                <div class="col-1"><p class="m-0">Status</p></div>
                <div class="col-2"><p class="m-0">Assigned Worker</p></div>
                <div class="col"><p class="m-0">Actions</p></div>
            </div>

            @foreach($customers as $customer)
                <div class="row text-muted text-center bg-white c-it anime my-2 shadow-md hover-up rounded-lg">

                    <div class="col-1 py-2">
                        <x-avatar class="shadow-sm" :for="$customer->profile->avatar" radius="10%" w="4rem" h="4rem"/>
                    </div>
                    <div class="col-1 py-1">{{ $customer->profile->user_name }}</div>
                    <div class="col-3 py-1">{{ $customer->email }}</div>
                    <div class="col-1 py-1">
                        <h4 class="m-0">
                            <span class="badge alert m-0 p-1 alert-{{ $customer->profile->status == 'online' ? 'success' : 'warning' }}">
                                {{ $customer->profile->status }}
                            </span>
                        </h4>
                    </div>
                    <div class="col-2 py-1">
                        @foreach($customer->user_worker as $worker)
                            <form type="hidden" id="{{$worker->id}}" class="d-none" action="{{route('unAssign.worker.from.customer')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$customer->id}}" name="customer">
                                <input type="hidden" value="{{$worker->id}}" name="unAssign_worker">
                            </form>
                            <button onclick="event.preventDefault();document.getElementById('{{$worker->id}}').submit();"
                                    class="anime hover-delete btn-sm btn my-1 px-2 rounded-pill btn-primary shadow-sm-primary d-flex flex-row justify-content-around">
                                <x-avatar class="shadow-sm mr-2" :for="$worker->profile->avatar" radius="100%" w="1.2rem" h="1.2rem"/>
                                <h6 class="m-0">{{$worker->profile->user_name}}</h6>
                            </button>
                        @endforeach
                    </div>
                    <div class="col py-1">
                        <form class="mb-1 d-flex flex-row justify-content-around"
                              action="{{route('assign.worker.to.customer')}}" method="post">
                            @csrf

                            <input type="hidden" value="{{$customer->id}}" name="customer">

                            <select name="assign_worker" class="form-control d-block mr-2 shadow-sm">
                                @foreach($workers as $worker)
                                    <option value="{{$worker->id}}">{{$worker->profile->user_name}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-outline-primary rounded-circle shadow-sm">
                                <x-icon i="linkIt" class="m-0 p-0" h=".7rem" w=".7rem"/>
                            </button>
                            <a href="/customers/{{$customer->id}}/edit" class="btn btn-link text-decoration-none ml-2 btn-primary rounded-lg shadow-sm-primary hovered">
                                <x-icon i="userCog" class="m-0 p-0" h="1.5rem" w="1.5rem"/>
                            </a>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
@endsection
