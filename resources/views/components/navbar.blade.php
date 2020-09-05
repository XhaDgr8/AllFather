<nav class="navbar nav_js navbar-expand navbar-light bg-white shadow-sm p-0"
     style="position: fixed;z-index: 230;width:inherit;max-width:inherit;min-width: inherit">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('order.create')}}" class="btn btn-link btn-outline-primary shadow-sm">
                        <x-icon i="cart" class="" h="1.3rem" w="1.3rem"/>
                        @if(session()->has('product.id'))
                            @if(count(session('product.id')) > 0 )
                                <span class="badge ml-2 bg-secondary">{{count(session('product.id'))}}</span>
                            @endif
                        @endif
                    </a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="p-1 border border-primary rounded-lg">
                                @php  $avatar = auth()->user()->profile->avatar @endphp
                                <x-avatar class="shadow-sm-primary" :for="$avatar" radius="100%" w="2rem" h="2rem"/>
                                {{ auth()->user()->profile->user_name }}
                                <span class="dropdown-toggle mx-1"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-md rounded-lg border-0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item hovered m-0 text-muted" href="{{ route('customers.pView') }}">
                                <x-icon i="userCog" class="mr-2" h="1rem" w="1rem"/>
                                Profile
                            </a>

                            <hr class="m-0">

                            {{--Logout Button --}}
                            <a class="dropdown-item m-0 hovered text-muted" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <x-icon i="powerOff" class="mr-2" h="1rem" w="1rem"/>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="p-4 mb-3"></div>
