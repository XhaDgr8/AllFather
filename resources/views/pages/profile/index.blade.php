@extends('layouts.contentLayoutMaster')
@section('page-vars')
    @php
        $active = "empty";
        $subActive = '';
        $title = 'Account Settings';
        $bread = ['Pages' ,'active' => 'Profile'];
    @endphp
@endsection

@section('content')

    <!-- account setting page start -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex py-75 text-dark active hovered" id="account-pill-general" data-toggle="pill"
                           href="#account-vertical-general" aria-expanded="true">
                            <x-icon i="circle" class="mr-2 mt-1" h="1rem" w="1rem"/>
                            General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex text-dark hovered py-75" id="account-pill-password" data-toggle="pill"
                           href="#account-vertical-password" aria-expanded="false">
                            <x-icon i="circle" class="mr-2 mt-1" h="1rem" w="1rem"/>
                            Change Password
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="card border-0 shadow-md rounded-lg">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                     aria-labelledby="account-pill-general" aria-expanded="true">
                                    <div class="row pb-2">
                                        <div class="col-auto">
                                            <a href="javascript: void(0);">
                                                @php  $avatar = auth()->user()->profile->avatar @endphp
                                                <x-avatar class="rounded mr-75" :for="$avatar" radius="100%"
                                                          w="3.5rem" h="3.5rem"/>
                                            </a>
                                        </div>
                                        <div class="col px-0 pt-2">
                                            <avatar-profile :id="{{auth()->user()->id}}"></avatar-profile>
                                        </div>
                                    </div>
                                    <div class="separator m-0"></div>
                                    <form method="post" action="/customers/{{auth()->user()->profile->id}}">
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
                                                <p class="text-muted mt-2 m-0 text-center">Update you Profile Information</p>
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
                                                              :label="auth()->user()->profile->pro_profile($proArray[$i]['field'], $proArray[$i]['else'])" value="" />
                                            @endfor
                                            <div class="col-12 mt-3 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary shadow-md-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                     aria-labelledby="account-pill-password" aria-expanded="false">
                                    <form method="POST" action="{{ route('password.confirm') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <x-text-input attr="required" name="password" class="my-2" type="password" label="Old Password" value="" />
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">New Password</label>
                                                        <input type="password" name="password" id="account-new-password" class="form-control"
                                                               placeholder="New Password" required
                                                               data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Retype New
                                                            Password</label>
                                                        <input type="password" name="con-password" class="form-control" required
                                                               id="account-retype-new-password" data-validation-match-match="password"
                                                               placeholder="New Password"
                                                               data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-outline-warning">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


