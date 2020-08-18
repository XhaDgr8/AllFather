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
        <div class="row">
            <div class="row py-3 text-center text-small text-muted">
                <div class="col-1"><p class="m-0">avatar</p></div>
                <div class="col-2"><p class="m-0">User Name</p></div>
                <div class="col-3"><p class="m-0">User Email</p></div>
                <div class="col-3"><p class="m-0">User Role(s)</p></div>
                <div class="col-3"><p class="m-0">actions</p></div>
            </div>
            @foreach($roles->users()->get() as $user)
                <div class="row text-muted text-center c-it shadow-lg rounded-lg">

                    <div class="col-1 py-1">
                        @php  $avatar = $user->profile->avatar @endphp
                        <x-avatar class="shadow-md" :for="$avatar" radius="10%" w="4.5rem" h="4.5rem"/>
                    </div>
                    <div class="col-2 py-1">{{ $user->profile->user_name }}</div>
                    <div class="col-3 py-1">{{ $user->email }}</div>
                    <div class="col-3 py-1">
                        <h5 class="font-weight-normal">
                            @foreach($user->roles as $userRole)
                                <span class="badge bg-primary shadow-md">{{$userRole->name}}</span>
                            @endforeach
                        </h5>
                    </div>
                    <div class="col-3 py-1">
                        <form class="mb-1 d-flex flex-row justify-content-center"
                              action="{{route('assign.role.to.user')}}" method="post">
                            @csrf

                            <input type="hidden" value="{{$user->id}}" name="user">

                            <select name="assign_role" class="form-control d-block mr-2 shadow-sm">
                                <option value="asdf">asdf</option>
                            </select>
                            <button type="submit" class="btn btn-outline-primary rounded-circle shadow-sm">
                                <x-icon i="linkIt" class="m-0 p-0" h=".7rem" w=".7rem"/>
                            </button>

                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
