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
            <div class="col-4">
                <div class="row">
                    <div class="col-12 my-3">
                        <h3 class="text-center alert alert-primary ">
                            {{$profile->user->email}}
                        </h3>
                    </div>
                    <div class="col-auto">
                        <a href="javascript: void(0);">
                            <x-avatar class="rounded mr-75" :for="$profile->avatar" radius=""
                                      w="5rem" h="5rem"/>
                        </a>
                    </div>
                    <div class="col px-0 pt-2">
                        <form method="Post" enctype="multipart/form-data" action="/imageUpload/{{$profile->id}}">
                            @csrf
                            <label class="btn btn-sm btn-outline-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                   for="account-upload">Upload new photo</label>
                            <input type="file" name="file" id="account-upload" hidden>
                            <button type="submit" class="btn btn-sm btn-primary ml-50">submit</button>
                        </form>
                        <p class="text-muted ml-75 mt-50">
                            <small>
                                Give the customer a nice looking image it can be helpfull
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <form method="post" action="/customers/{{$profile->user->id}}">
                    @csrf @method('PATCH')
                    <div class="row">
                        <div class="col-12">
                            @if($errors->any())
                                <p class="alert alert-danger">{{$errors->first()}}</p>
                            @endif
                            <p class="text-muted mt-2 m-0 text-center">Update Customers Profile Information</p>
                        </div>
                        <div class="col-12">
                            <x-text-input attr="required" name="user_name" type="text" class="my-2"
                                          :label="$pro_profile['user_name']" value="" />
                        </div>
                        <div class="col-12">
                            <x-text-input attr="required" name="address" type="text" class="my-2" :label="$pro_profile['address']" value="" />
                        </div>
                        <div class="col-12">
                            <x-text-input attr="required" name="company_number" type="text" class="my-2" :label="$pro_profile['company_number']" value="" />
                        </div>
                        <div class="col-12">
                            <x-text-input attr="required" name="tel" type="text" class="my-2" :label="$pro_profile['tel']" value="" />
                        </div>
                        <div class="col-12">
                            <x-text-input attr="required" name="website" type="text" class="my-2" :label="$pro_profile['website']" value="" />
                        </div>
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
