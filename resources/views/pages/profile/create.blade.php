@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "sub_products";
        $subActive = 'sub_products_create';
        $title = 'Account Settings';
        $bread = ['Sub Products', 'active' => 'Creat Sub Product'];
    @endphp
@endsection
@section('content')
    profile.create template
@endsection
