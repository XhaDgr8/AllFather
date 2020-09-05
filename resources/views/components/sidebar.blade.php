@php
    $menus = [
            [
                'active' => $active, 'id' => 'home',
                'name' => 'Home', 'icon' => 'home',
                'url' => '/home',
                'sub' => [],
                'roles' => [
                    'admin', 'worker', 'customer'
                ]
            ],
            [
                'active' => $active, 'id' => 'ability_role',
                'name' => 'Roles & Abilities', 'icon' => 'stayLinked',
                'url' => '/ability_role',
                'sub' => [],
                'roles' => [
                    'admin'
                ]
            ],
            [
                "url" => "#",
                "name" => "Users",
                "id" => "customers",
                "icon" => "userCog",
                "active" => $active,
                'sub' => [
                    ["url" => "/customer/create", "name" => "Create User", "id" => 'customer_create', 'active' => $subActive],
                    ["url" => "/customer/all", "name" => "All Users", "id" => 'customer_all', 'active' => $subActive]
                ],
                'roles' => [
                    'worker'
                ]
            ],
            [
                "url" => "#",
                "name" => "Sub Products",
                "id" => "sub_products",
                "icon" => "product",
                "active" => $active,
                'sub' => [
                    ["url" => "/sub-product/create", "name" => "Create SubProducts", "id" => 'sub_products_create', 'active' => $subActive],
                    ["url" => "/sub-product", "name" => "All Sub Products", "id" => 'sub_products_all', 'active' => $subActive],
                ],
                'roles' => [
                    'worker'
                ]
            ],
            [
                "url" => "#",
                "name" => "Products",
                "id" => "products",
                "icon" => "productHunt",
                "active" => $active,
                'sub' => [
                    ["url" => "/product/create", "name" => "Create Products", "id" => 'products_create', 'active' => $subActive],
                    ["url" => "/product", "name" => "All Products", "id" => 'products_all', 'active' => $subActive],
                ],
                'roles' => [
                    'worker'
                ]
            ],
            [
                'active' => $active, 'id' => 'orders',
                'name' => 'All Orders', 'icon' => 'cart',
                'url' => '/order',
                'sub' => [],
                'roles' => [
                    'admin', 'worker', 'customer'
                ]
            ],
        ];
@endphp
<div id="theside" class="p-0 position-fixed"
     style="
         z-index: 2;min-height: 100%;
         width:inherit;max-width:inherit;">
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
            <a class="navbar-brand d-flex nav-link" href="{{ url('/') }}">
                <img src="{{asset('storage/sa/logo/logo.gif')}}"
                     style="max-height: 2.5rem"
                     alt="" class="img-fluid float-left m-0 p-0">
                <h1 style="font-size: 1.3rem"
                    class="float-left d-md-block d-none logo-text font-monospace
                     font-weight-bold m-0 mt-2 ml-2 float-left">Perfuniq</h1>
            </a>
        </div>
        <a id="toggle-sidebar" class="col-2 btn border-0 pointer open p-0 d-flex flex-column justify-content-center">
            <x-icon i="dotCircle" class="text-primary" h="1rem" w="1rem"/>
        </a>
    </nav>
    <div class="mt-2">
        <div class="accordion" id="accord">
            <div class="container">
                @if(auth()->user()->is_role('admin'))
                    @foreach($menus as $menu)
                        <x-menu-items :menu="$menu" :subs="$menu['sub']"/>
                    @endforeach
                @else
                    @if(auth()->user()->is_role('customer'))
                        @foreach($menus as $menu)
                            @if(in_array('customer',$menu['roles']))
                                <x-menu-items :menu="$menu" :subs="$menu['sub']"/>
                            @endif
                        @endforeach
                    @endif
                    @if(auth()->user()->is_role('worker'))
                        @foreach($menus as $menu)
                            @if(in_array('worker',$menu['roles']))
                                <x-menu-items :menu="$menu" :subs="$menu['sub']"/>
                            @endif
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
