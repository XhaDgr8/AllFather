<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class sidebar extends Component
{
    public $active;
    public $subActive;

    /**
     * Create a new component instance.
     *
     * @param $active
     * @param $subActive
     */
    public function __construct($active, $subActive)
    {
        $this->active = $active;
        $this->subActive = $subActive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.sidebar');
    }

    public function menus()
    {
        return [
            [
                'active' => $this->active, 'id' => 'home',
                'name' => 'Home', 'icon' => 'home',
                'url' => '/home',
                'sub' => [],
                'roles' => [
                    'admin', 'worker', 'customer'
                ]
            ],
            [
                'active' => $this->active, 'id' => 'ability_role',
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
                "active" => $this->active,
                'sub' => [
                    ["url" => "/customer/create", "name" => "Create User", "id" => 'customer_create', 'active' => $this->subActive],
                    ["url" => "/customer/all", "name" => "All Users", "id" => 'customer_all', 'active' => $this->subActive]
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
                "active" => $this->active,
                'sub' => [
                    ["url" => "/sub-product/create", "name" => "Create SubProducts", "id" => 'sub_products_create', 'active' => $this->subActive],
                    ["url" => "/sub-product", "name" => "All Sub Products", "id" => 'sub_products_all', 'active' => $this->subActive],
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
                "active" => $this->active,
                'sub' => [
                    ["url" => "/product/create", "name" => "Create Products", "id" => 'products_create', 'active' => $this->subActive],
                    ["url" => "/product", "name" => "All Products", "id" => 'products_all', 'active' => $this->subActive],
                ],
                'roles' => [
                    'worker'
                ]
            ],
            [
                'active' => $this->active, 'id' => 'orders',
                'name' => 'All Orders', 'icon' => 'cart',
                'url' => '/order',
                'sub' => [],
                'roles' => [
                    'admin', 'worker', 'customer'
                ]
            ]
        ];
    }

}
