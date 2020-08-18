<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sidebar extends Component
{
    public $active;

    /**
     * Create a new component instance.
     *
     * @param $active
     */
    public function __construct($active)
    {
        //
        $this->active = $active;
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

    public function navLinks () {
        return [
            [
                "url" => "/ability_role", "name" => "Roles & Abilities", "slug" => "ability_role", "icon" => "stayLinked",
                "for" => ['page_admin'],
            ],
            [
                "url" => "/link1", "name" => "Dashboard", "slug" => "dashboard", "icon" => "github",
                "for" => ['page_admin', 'page_worker'],
                "subMenu" => [
                    [
                        "url" => "/subLink", "name" => "Sub Link 1", "slug" => "subLink"
                    ],
                    [
                        "url" => "/subLink", "name" => "Sub Link 2", "slug" => "subLink"
                    ]
                ]
            ],
            [
                "url" => "/link2", "name" => "Link 2", "slug" => "link_2", "icon" => "home",
                "for" => ['page_admin', 'page_customer'],
                "subMenu" => [
                    [
                        "url" => "/subLink2", "name" => "subLink2", "slug" => "subLink2"
                    ]
                ]
            ]
        ];
    }

}
