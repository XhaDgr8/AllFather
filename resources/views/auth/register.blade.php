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
                                <div class="form-group my-4">
                                    <fieldset class="w-100 position-relative">
                                        <input id="name" type="name"
                                               class="form-control border @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}"
                                               placeholder="auto"
                                               required autocomplete="name" autofocus>
                                        <label for="name">{{ __('Full Name') }}</label>
                                    </fieldset>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

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

                                <div class="form-group mt-4 mb-2">
                                    <fieldset class="w-100 position-relative">
                                        <input id="password-confirm" type="password"
                                               class="form-control border @error('password-confirm') is-invalid @enderror"
                                               name="password_confirmation" value="{{ old('password-confirm') }}"
                                               placeholder="auto"
                                               required autocomplete="password" autofocus>
                                        <label for="password">{{ __('Confirm Password') }}</label>
                                    </fieldset>

                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

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
