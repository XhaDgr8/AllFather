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
                                <div class="form-group my-4">
                                    <fieldset class="w-100 position-relative">
                                        <input id="email" type="email"
                                               class="form-control border @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}"
                                               placeholder="auto"
                                               required autocomplete="email" autofocus>
                                        <label for="email">{{ __('User Name @ Perfunic.Com') }}</label>
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

