@extends('layouts.contentLayoutMaster')

@section('page-vars')
    @php
        $active = "";$subActive = '';
        $title = "Welcome Home";
        $bread = [];
    @endphp
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>
                        'You are logged in! as
                        @foreach(auth()->user()->roles as $userRole)
                            <p class="badge bg-primary shadow-sm-primary">{{$userRole->label}}</p>
                        @endforeach
                    </h5>
                    <div class="mt-3">
                        <button class="modelToggler btn btn-outline-primary shadow-lg">Modal Show</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
