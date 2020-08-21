@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "empty";
        $subActive = 'sub_products_all';
        $title = 'Account Settings';
        $bread = ['Sub Products', 'active' => 'All Sub Products'];
    @endphp
@endsection
@section('content')
    profile.show template
@endsection
