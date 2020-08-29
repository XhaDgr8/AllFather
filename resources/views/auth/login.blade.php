@extends('layouts.fullLayoutMaster')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 shadow-lg rounded-lg overflow-hidden">
            <div class="row">
                <div class="col-md-6 d-flex flex-column justify-content-center bg-light">
                    <img src="{{asset('storage/sa/login.png')}}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6 bg-white py-5">
                    <div class="container">
                        <h4>{{ __('Login') }}</h4>
                        <p class="mb-3">Welcome back, please login to your account.</p>
                        @if($errors->any())
                            <p class="alert alert-danger">{{$errors->first()}}</p>
                        @endif
                        @if(isset($msg))
                            <p class="alert alert-info">{{$msg}}</p>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group my-4">
                                <fieldset class="w-100 position-relative">
                                    <input id="email" type="email"
                                           class="form-control border @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}"
                                           placeholder="auto"
                                           required autocomplete="email" autofocus>
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                </fieldset>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-4 mb-2">
                                <fieldset class="w-100 position-relative">
                                    <input id="password" type="password"
                                           class="form-control border @error('password') is-invalid @enderror"
                                           name="password" value="{{ old('password') }}"
                                           placeholder="auto"
                                           required autocomplete="password" autofocus>
                                    <label for="password">{{ __('Password') }}</label>
                                </fieldset>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row my-1 g-0">
                                <div class="col-md-6">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input"
                                               type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-6">
                                    <a href="/register" type="submit" class="btn btn-sm btn-link btn-outline-primary">
                                        {{ __('Register') }}
                                    </a>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-block shadow-sm-primary text-white btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="separator my-4">OR</div>

                        <div class="my-3 row">
                            <div class="col-3">
                                <a href="login/github" class="btn btn-link btn-dark shadow-sm-primary">
                                    <x-icon i="github" class="text-white" h="2.3rem" w="2.3rem"/>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="login/facebook" style="background-color: #4285F4" class="btn btn-link shadow-sm-primary">
                                    <x-icon i="facebook" class="text-white" h="2.3rem" w="2.3rem"/>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="login/google" style="background-color: #d34836" class="btn btn-link shadow-sm-primary">
                                    <x-icon i="google" class="text-white" h="2.3rem" w="2.3rem"/>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="login/twitter" disabled style="background-color: #00acee" class="btn btn-link shadow-sm-primary">
                                    <x-icon i="twitter" class="text-white" h="2.3rem" w="2.3rem"/>
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
