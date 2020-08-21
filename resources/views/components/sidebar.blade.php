
<div id="theside" class="p-0 position-fixed"
     style="
         z-index: 2;min-height: 100%;
         width:inherit;max-width:inherit;;"
>
    <div id="particles-js" class="position-absolute w-100 h-100" style="z-index: 0"></div>
</div>
<div id="theside" class="p-0 position-fixed"
     style="
         z-index: 22;min-height: 100%;
         width:inherit;max-width:inherit;
         overflow-x: hidden;
         background-image: url('{{asset("storage/sa/sidebarBg.png")}}');
         background-position: bottom;background-repeat: no-repeat;background-size: contain;"
>

    <nav class="g-0 py-2 row bg-white position-relative" style="min-width: 13rem;z-index: 33">
        <div class="col-10 p-0">
            <a class="navbar-brand nav-link" href="{{ url('/') }}">
                <img src="{{asset('storage/sa/logo/logo.gif')}}" style="max-height: 3rem"
                     alt="" class="img-fluid float-left">
                <h1 style="font-size: 1.5rem" class="float-left d-md-block d-none logo-text font-monospace font-weight-bold m-0 mt-2">Perfumic</h1>
            </a>
        </div>
        <div id="toggle-sidebar" class="col-2 pointer open p-0 d-flex flex-column justify-content-center">
            <x-icon i="dotCircle" class="text-primary" h="1rem" w="1rem"/>
        </div>
    </nav>
    <div class="mt-2">
        <div class="accordion" id="accord">
            <div class="container">
                @if(auth()->user()->is_role('admin'))
                    @foreach($menus as $menu)
                        <x-menue-items :menu="$menu" :subs="$menu['sub']"/>
                    @endforeach
                @else
                    @if(auth()->user()->is_role('worker'))
                        @foreach($menus as $menu)
                            @if(in_array('worker', $menu['roles']))
                                <x-menue-items :menu="$menu" :subs="$menu['sub']"/>
                            @endif
                        @endforeach
                    @endif
                    @if(auth()->user()->is_role('customer'))
                        @foreach($menus as $menu)
                            @if(in_array('customer', $menu['roles']))
                                <x-menue-items :menu="$menu" :subs="$menu['sub']"/>
                            @endif
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
