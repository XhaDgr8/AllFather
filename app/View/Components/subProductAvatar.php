<?php

namespace App\View\Components;

use Illuminate\View\Component;

class subProductAvatar extends Component
{
    public $w;
    public $h;
    public $radius;
    public $class;
    public $for;
    public $alt;

    /**
     * Create a new component instance.
     *
     * @param $w
     * @param $h
     * @param $radius
     * @param $class
     * @param $for
     * @param $alt
     */
    public function __construct($w, $h, $radius, $class, $for, $alt)
    {
        //
        $this->w = $w;
        $this->h = $h;
        $this->radius = $radius;
        $this->class = $class;
        $this->for = $for;
        $this->alt = $alt;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sub-product-avatar');
    }
}
