<?php

namespace App\View\Components;

use Illuminate\View\Component;

class avatar extends Component
{
    public $w;
    public $h;
    public $class;
    public $radius;
    public $for;

    /**
     * Create a new component instance.
     *
     * @param $w
     * @param $h
     * @param $radius
     * @param $class
     * @param $for
     */
    public function __construct($w, $h, $radius, $class, $for)
    {
        $this->w = $w;
        $this->h = $h;
        $this->radius = $radius;
        $this->class = $class;
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.avatar');
    }
}
