@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "customers";
        $subActive = "customer_create";
        $title = 'Create New Customer';
        $bread = ['Pages' ,'active' => 'Create Customer'];
    @endphp
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 shadow-lg rounded-lg overflow-hidden">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column justify-content-center bg-light">
                        <img src="{{asset('storage/sa/register.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-6 bg-white py-4">
                        <div class="container">
                            <h4>{{ __('Create Account') }}</h4>
                            <p class="mb-3 alert alert-info p-2 m-0">The email should be like this 'user_name@Perfunic.company' but you can name it anything we use the email as a backend id for managing the user.</p>
                            @if($errors->any())
                                <p class="alert alert-danger">{{$errors->first()}}</p>
                            @endif
                            <form method="POST" action="{{ route('new.customer.create') }}">
                                @csrf @method('PATCH')
                                <x-text-input attr="required" name="user_name" type="text" class="my-3" label="User Name" value="" />
                                <x-text-input attr="required" name="email" type="text" class="my-3" label="Email" value="" />
                                <x-text-input attr="required" name="password" type="text" class="my-3" label="Password" value="" />
                                <x-text-input attr="required" name="password_confirmation" type="text" class="my-3" label="Confirm Password" value="" />
                                <div class="form-group row mt-3 mb-0">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-block shadow-sm-primary text-white btn-primary">
                                            {{ __('Create') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

