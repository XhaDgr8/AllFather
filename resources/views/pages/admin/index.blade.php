@extends('layouts.contentLayoutMaster')

@section('page-vars')
    @php
        $active = "ability_role";
        $subActive = '';
        $title = "Roles & Abilities management";
        $bread = ['Admin', 'Pages' ,'active' => 'Ability_Role'];
    @endphp
@endsection

@section('content')
    <div class="container">
        {{-- Only For Admin Use--}}
        <div class="container my-5"><a href="/makeDefaults" class="btn btn-outline-primary btn-block shadow">Reset To Defaults</a></div>
        <div class="row shadow-md border py-3 rounded-lg bg-white border-primary">
            <div class="col-12"><h4 class="text-center">Ability Management</h4></div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-0">There Are In Total {{count($abilities)}} roles available</div>

                    <div class="card-body">
                        @if (session()->has('ability.updated'))
                            <div class="p-0 px-2 alert alert-success">
                                {{session('ability.updated')}}
                            </div>
                        @endif
                        <div class="row border border-primary py-2 mb-2">
{{--                            <div class="col">Name</div>--}}
                            <div class="col-auto">Id</div>
                            <div class="col">Name</div>
                            <div class="col-4">Actions</div>
                        </div>
                        @foreach($abilities as $ability)
                            <div class="row my-2">
                                <form method="post" action="ability/{{$ability->id}}" class="col-10">
                                    @csrf @method('PATCH')
                                    <div class="row">
{{--                                        <div class="col">--}}
{{--                                            <x-text-input attr="required" name="name" type="text" class="" :label="$ability->name" value="" />--}}
{{--                                        </div>--}}
                                        <div class="col-auto">
                                            {{$ability->id}}
                                        </div>
                                        <div class="col">
                                            <x-text-input attr="required" name="label" type="text" class="" :label="$ability->label" value="" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit"
                                                    class="btn btn-outline-primary btn-sm rounded-lg shadow-sm">
                                                update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-auto">
                                    <form action="ability/{{$ability->id}}" method="post">
                                        @csrf @method("DELETE")
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-lg shadow-sm">
                                            <x-icon i="trash" class="m-0 p-0" h="1rem" w="1rem"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-0">Create New Abilities</div>

                    <div class="card-body pt-0">
                        <form method="post" action="{{ route('ability.store') }}">
                            @csrf

                            @if (session()->has('ability.id'))
                                <div class="p-0 px-2 alert alert-{{session('ability.id')[0]}}">
                                    {{session('ability.id')[1]}}
                                </div>
                            @endif
                            <div class="p-0 m-0 px-2 alert alert-info">
                                Do not add spaces in Name Field it is for backend usage
                                <br>
                                This label will be visible to you
                            </div>
                            <x-text-input attr="required" name="name" type="text" class="mb-2 mt-3" label="Ability Name" value="" />
                            <x-text-input attr="required" name="label" type="text" class="mt-3 mb-2" label="Ability Label" value="" />
                            <button type="submit" class="btn-outline-primary mt-3 btn btn-block shadow-sm">
                                <x-icon i="plus" class="m-0 mr-2 p-0" h="1.5rem" w="1.5rem"/>
                                Make Ability
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row shadow-md border my-5 py-3 rounded-lg bg-white border-primary">
            <div class="col-12"><h4 class="text-center">Roles Management</h4></div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-0"><p class="m-0">There Are In Total {{count($roles)}} roles available</p></div>

                    <div class="card-body">
                        @if (session()->has('role.updated'))
                            <div class="p-0 px-2 alert alert-success">
                                {{session('role.updated')}}
                            </div>
                        @endif
                        <div class="row border border-primary py-2 mb-2">
                            <div class="col">Name</div>
                            <div class="col">Label</div>
                            <div class="col-4">Actions</div>
                        </div>
                        @foreach($roles as $role)
                            <div class="row my-2">
                                <form method="post" action="role/{{$role->id}}" class="col-10">
                                    @csrf @method('PATCH')
                                    <div class="row">
                                        <div class="col">
                                            <x-text-input attr="required" name="name" type="text" class="" :label="$role->name" value="" />
                                        </div>
                                        <div class="col">
                                            <x-text-input attr="required" name="label" type="text" class="" :label="$role->label" value="" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit"
                                                    class="btn btn-outline-primary btn-sm rounded-lg shadow-sm">
                                                update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-auto">
                                    <form action="role/{{$role->id}}" method="post">
                                        @csrf @method("DELETE")
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-lg shadow-sm">
                                            <x-icon i="trash" class="m-0 p-0" h="1rem" w="1rem"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header border-0">Create New Role</div>

                    <div class="card-body pt-0">
                        <div class="p-0 m-0 mb-3 px-2 alert alert-info">
                            Do not add spaces in Name Field it is for backend usage
                            <br>
                            This label will be visible to you
                        </div>
                        <form method="post" action="{{ route('role.store') }}">
                            @csrf

                            @if (session()->has('role.id'))
                                <div class="p-0 px-2 alert alert-{{session('role.id')[0]}}">
                                    {{session('role.id')[1]}}
                                </div>
                            @endif

                            <x-text-input attr="required" name="name" type="text" class="my-2" label="Role Name" value="" />
                            <x-text-input attr="required" name="label" type="text" class="mt-3 mb-2" label="Role Label" value="" />
                            <button type="submit" class="btn-outline-primary mt-3 btn btn-block shadow-sm">
                                <x-icon i="plus" class="m-0 mr-2 p-0" h="1.5rem" w="1.5rem"/>
                                Make Role
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Roles Table --}}
        <div class="container shadow-md border rounded-lg border-primary bg-white my-5 py-3">
            <div class="py-4">
                <h1 class="text-center">Assign Abilities To the Roles</h1>
                <div class="alert alert-primary mx-5">
                    <h4 class="font-weight-bold">
                        Instructions For Admin
                    </h4>
                    <p>The Admin Can perform any operation in the application;</p>
                    <p>A Role that will be assigned a specific ability will be able to perform
                        those tasks that the ability allows to that particular role.</p>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>There Are In Total {{count($roles)}} roles available</h5>
                            <ol>
                                @foreach($roles as $role)
                                    <li>{{ $role->label }}</li>
                                @endforeach
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h5>There Are In Total {{ count($abilities) }} Abilities available</h5>
                            <ol>
                                @foreach($abilities as $ability)
                                    <li>{{ $ability->label }}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row text-center shadow-sm border text-info font-weight-bold py-3">
                        <div class="col">#</div>
                        <div class="col">Role Name</div>
                        <div class="col">Assign Ability to Role</div>
                    </div>
                    @foreach($roles as $role)
                        <div class="row text-center my-3 shadow-sm border pt-2">
                            <div class="col">{{ $role->id }}</div>
                            <div class="col"><h4 class="text-primary">{{ $role->label }}</h4></div>
                            <div class="col">
                                <form class="mb-1 d-flex flex-row justify-content-center" action="/role/assignAbility" method="post">
                                    @csrf

                                    <input type="hidden" value="{{$role->id}}" name="role">

                                    <select name="assign_ability" class="form-control d-block mr-2 shadow-sm">
                                        @foreach($abilities as $ability)
                                            <option value="{{ $ability->name }}">{{ $ability->label }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary rounded-circle shadow-sm">
                                        <x-icon i="linkIt" class="m-0 p-0" h=".7rem" w=".7rem"/>
                                    </button>

                                </form>
                            </div>
                            <div class="col-12">
                                <div class="col-4 my-2"><h4 class="text-center text-info">Have The Abilities</h4></div>
                                <x-assigner
                                    :assigner="[
                                            'for' => $role, 'to' => $role->abilities, 'route' => 'detach.ability.from.role',
                                            'forName' => 'role', 'toName' => 'detach_ability'
                                        ]" class=""
                                />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Users Table --}}
        <div class="container shadow-md border rounded-lg border-primary bg-white my-5 py-3">
            <div class="p-0 py-4">
                <h1 class="text-center">User Management</h1>
                <div class="row w-auto m-auto mx-2">
                    <div class="col-12 text-center shadow-sm border text-info font-weight-bold">
                        <div class="row py-3">
                            <div class="col-1">#</div>
                            <div class="col-2">User Name</div>
                            <div class="col-3">User Email</div>
                            <div class="col-3">User Role(s)</div>
                            <div class="col-3">Assign User Role</div>
                        </div>
                    </div>
                    <div class="col-12">
                        @foreach($users as $user)
                            <div class="row text-center shadow-sm border">

                                <div class="col-1 py-1">
                                    @php  $avatar = $user->profile->avatar @endphp
                                    <x-avatar class="" :for="$avatar" radius="100%" w="2.5rem" h="2.5rem"/>
                                </div>
                                <div class="col-2 py-1">{{ $user->profile->user_name }}</div>
                                <div class="col-3 py-1">{{ $user->email }}</div>
                                <div class="col-3 py-1">
                                    <x-assigner
                                        :assigner="[
                                            'for' => $user, 'to' => $user->roles, 'route' => 'detach.role.from.user',
                                            'forName' => 'user', 'toName' => 'detach_role'
                                        ]" class=""
                                    />
                                </div>
                                <div class="col-3 py-1">
                                    <form class="mb-1 d-flex flex-row justify-content-center"
                                          action="{{route('assign.role.to.user')}}" method="post">
                                        @csrf

                                        <input type="hidden" value="{{$user->id}}" name="user">

                                        <select name="assign_role" class="form-control d-block mr-2 shadow-sm">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->label }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-outline-primary rounded-circle shadow-sm">
                                            <x-icon i="linkIt" class="m-0 p-0" h=".7rem" w=".7rem"/>
                                        </button>

                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
