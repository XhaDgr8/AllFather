<div id="theside" class="p-0 position-fixed"
     style="z-index: 22;width:inherit;max-width:inherit;overflow-x: hidden">
    <nav class="g-0 py-2 row" style="min-width: 13rem">
        <div class="col-10 p-0">
            <a class="navbar-brand nav-link" href="{{ url('/') }}">
                <img src="{{asset('storage/sa/logo/logo_sm.png')}}" alt="" style="max-height: 2rem"
                     class="img-fluid d-md-none d-block logo-sm ml-1">
                <img src="{{asset('storage/sa/logo/logo_lg.png')}}" alt="" class="img-fluid d-md-block d-none logo-lg">
            </a>
        </div>
        <div id="toggle-sidebar" class="col-2 pointer open p-0 d-flex flex-column justify-content-center">
            <x-icon i="dotCircle" class="text-primary" h="1rem" w="1rem"/>
        </div>
    </nav>
    <div class="mt-2">
        <div class="accordion" id="accord">
            <div class="container">
                @if (auth()->user()->roles()->where('name', 'admin')->exists())
                    @php
                        $menu = [
                                    'active' => $active,
                                    'id' => 'ability_role',
                                    'name' => 'Roles & Abilities',
                                    'icon' => 'stayLinked',
                                    'url' => '/ability_role'
                                ];
                        $subs = [];
                    @endphp
                    <x-menue-items :subs="$subs" :menu="$menu"/>

                    @php
                        $menu = [
                            "url" => "#",
                            "name" => "Customers",
                            "id" => "customers",
                            "icon" => "home",
                            "active" => $active
                        ];
                        $subs = [
                            ["url" => "/customer/create", "name" => "Create Customer", "id" => 'customer_create', 'active' => $subActive],
                            ["url" => "/customer/all", "name" => "All Customers", "id" => 'customer_all', 'active' => $subActive]
                        ]
                    @endphp
                    <x-menue-items :subs="$subs" :menu="$menu"/>
                @else

                @endif
            </div>
        </div>
    </div>
</div>

