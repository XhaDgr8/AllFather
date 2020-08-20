@extends('layouts.fullLayoutMaster')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 shadow-lg rounded-lg overflow-hidden">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column justify-content-center bg-light">
                        <img src="{{asset('storage/sa/register.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-6 bg-white py-4">
                        <div class="container">
                            <h4>{{ __('Create Account') }}</h4>
                            <p class="mb-3">Fill the below form to create a new account.</p>
                            @if($errors->any())
                                <p class="alert alert-danger">{{$errors->first()}}</p>
                            @endif
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <x-text-input attr="required" name="user_name" type="text" class="my-3" label="User Name" value="" />
                                <x-text-input attr="required" name="email" type="text" class="my-3" label="Email" value="" />
                                <x-text-input attr="required" name="password" type="text" class="my-3" label="Password" value="" />
                                <x-text-input attr="required" name="password_confirmation" type="text" class="my-3" label="Confirm Password" value="" />

                                <div class="form-group row my-1 g-0">
                                    <div class="col-12">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input"
                                                   type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('I accept the terms & conditions.') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-6">
                                        <a href="/login" type="submit" class="btn btn-sm btn-link btn-outline-primary">
                                            {{ __('Login') }}
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-block shadow-sm-primary text-white btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="separator my-4">OR</div>

                            <div class="my-3 row">
                                <div class="col-3">
                                    <a href="login/github" class="btn btn-link shadow-md btn-dark">
                                        <img src="{{asset('storage/sa/icons/github-alt-brands.svg')}}"
                                             class="img-fluid" style="width: 2rem; height: 2rem" alt="">
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="login/facebook" style="background-color: #4285F4" class="btn btn-link shadow-sm">
                                        <img src="{{asset('storage/sa/icons/facebook-f-brands.svg')}}"
                                             class="img-fluid px-2" style="width: 2rem; height: 2rem" alt="">
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="login/google" style="background-color: #d34836" class="btn btn-link shadow-sm">
                                        <img src="{{asset('storage/sa/icons/google-brands.svg')}}"
                                             class="img-fluid" style="width: 2rem; height: 2rem" alt="">
                                    </a>
                                </div>
                                <div class="col-3">
                                    <a href="login/google" style="background-color: #00acee" class="btn btn-link shadow-sm">
                                        <img src="{{asset('storage/sa/icons/twitter-brands.svg')}}"
                                             class="img-fluid" style="width: 2rem; height: 2rem" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
