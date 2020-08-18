<?php

namespace App\View\Components;

use Illuminate\View\Component;

class menueItems extends Component
{
    public $subs;
    public $menu;

    /**
     * Create a new component instance.
     *
     * @param $subs
     * @param $menu
     */
    public function __construct($subs, $menu)
    {
        //
        $this->subs = $subs;
        $this->menu = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menue-items');
    }
}
