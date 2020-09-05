@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "customers";
        $subActive = '';
        $title = 'Customer Account Settings';
        $bread = ['Customer' ,'active' => 'edit Profile'];
    @endphp
@endsection

@section('content')

    <div class="container">
        <div class="row shadow-md bg-white py-4 rounded-lg">
            <div class="col-4 mh-100 bg-light rounded-right pt-3 position-relative">
                <div class="mb-5">
                    <h3 class="text-center alert alert-primary ">
                        {{$profile->user_name}}
                    </h3>
                </div>
                <div class="row mb-5">
                    <div class="col-auto">
                        <a href="javascript: void(0);">
                            <x-avatar class="rounded mr-75" :for="$profile->avatar" radius=""
                                      w="5rem" h="5rem"/>
                        </a>
                    </div>
                    <div class="col px-0 pt-2">
                        <avatar-profile :id="{{$profile->id}}"></avatar-profile>
                        <p class="text-muted ml-75 mt-50">
                            <small>
                                Give the customer a nice looking image it can be helpfull
                            </small>
                        </p>
                    </div>
                </div>
                @can('d_users')
                    <div class="bg-dark p-2 mt-5">
                        <p class="text-danger">Remember Deleting The Customer Means that you Delete everything Related to this Customer</p>
                        <form action="/customer/{{$profile->user->id}}" class="my-3" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-lg shadow-sm">
                                <x-icon i="trash" class="m-0 p-0" h=".6rem" w=".6rem"/> Delete Customer
                            </button>
                        </form>
                    </div>
                @endcan
            </div>
            <div class="col">
                <div class="col-12">
                    <div class="row">
                        @can('attach_role')
                            <div class="col-6">
                                <h5 class="">Assign a Role to this Customer</h5>
                                <form class="mb-1 d-flex flex-row justify-content-center"
                                      action="{{route('assign.role.to.user')}}" method="post">
                                    @csrf

                                    <input type="hidden" value="{{$profile->user->id}}" name="user">

                                    <select name="assign_role" class="form-control d-block mr-2 shadow-sm">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->label }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary rounded-circle shadow-sm">
                                        <x-icon i="linkIt" class="m-0 p-0" h=".7rem" w=".7rem"/>
                                    </button>
                                </form>
                            </div>
                        @endcan
                        @can('attach_worker')
                            <div class="col-6">
                                <h5 class="">Assign a Worker to this Customer</h5>
                                <form class="mb-1 d-flex flex-row justify-content-around"
                                      action="{{route('assign.worker.to.customer')}}" method="post">
                                    @csrf

                                    <input type="hidden" value="{{$profile->user->id}}" name="customer">

                                    <select name="assign_worker" class="form-control text-dark d-block mr-2 shadow-sm">
                                        @foreach($workers as $worker)
                                            <option value="{{$worker->id}}">{{$worker->profile->user_name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary rounded-circle shadow-sm">
                                        <x-icon i="linkIt" class="m-0 p-0" h=".7rem" w=".7rem"/>
                                    </button>
                                </form>
                            </div>
                        @endcan

                    </div>
                </div>
                <form method="post" action="/customers/{{$profile->user->id}}">
                    @csrf @method('PATCH')
                    <div class="row">
                        <div class="col-12">
                            @if($errors->any())
                                <p class="alert alert-danger">{{$errors->first()}}</p>
                            @endif
                            @if (session()->has('customer.updated'))
                                <div class="p-0 px-2 alert alert-success">
                                    {{session('customer.updated')}}
                                </div>
                            @endif
                            <p class="text-muted mt-2 m-0 text-center">Update Customers Profile Information</p>
                        </div>
                        @php
                            $proArray = [
                                ['field' => 'user_name', 'else' => 'User Name'],
                                ['field' => 'address', 'else' => 'Address'],
                                ['field' => 'company_number', 'else' => 'Company Number'],
                                ['field' => 'tel', 'else' => 'Tel'],
                                ['field' => 'vat_no', 'else' => 'Vat No']
                            ]
                        @endphp
                        @for($i = 0; $i < count($proArray); $i++)
                            <x-text-input attr="" :name="$proArray[$i]['field']" type="text" class="my-3"
                                          :label="$profile->pro_profile($proArray[$i]['field'], $proArray[$i]['else'])" value="" />
                        @endfor
                        <input name="status" type="hidden" value="" />
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                            <button type="submit" class="btn btn-primary shadow-md-primary mr-sm-1 mb-1 mb-sm-0">Save
                                changes</button>
                            <button type="reset" class="btn btn-outline-warning">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
