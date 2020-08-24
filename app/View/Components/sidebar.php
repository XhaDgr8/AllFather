<?php

namespace App\View\Components;

use Illuminate\View\Component;

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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebar');
    }

    public function menus ()
    {
        return [
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
                "name" => "Customers",
                "id" => "customers",
                "icon" => "userCog",
                "active" => $this->active,
                'sub' => [
                    ["url" => "/customer/create", "name" => "Create Customer", "id" => 'customer_create', 'active' => $this->subActive],
                    ["url" => "/customer/all", "name" => "All Customers", "id" => 'customer_all', 'active' => $this->subActive]
                ],
                'roles' => [
                    'worker'
                ]
            ],
            [
                "url" => "#",
                "name" => "Sub Products",
                "id" => "sub_products",
                "icon" => "plus",
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
                "icon" => "plus",
                "active" => $this->active,
                'sub' => [
                    ["url" => "/product/create", "name" => "Create Products", "id" => 'products_create', 'active' => $this->subActive],
                    ["url" => "/product", "name" => "All Products", "id" => 'products_all', 'active' => $this->subActive],
                ],
                'roles' => [
                    'worker'
                ]
            ]
        ];
    }

}
