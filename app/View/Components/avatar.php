<?php

namespace App\View\Components;

use Illuminate\View\Component;

class avatar extends Component
{
    public $w;
    public $h;
    public $class;
    public $radius;

    /**
     * Create a new component instance.
     *
     * @param $w
     * @param $h
     * @param $class
     * @param $radius
     */
    public function __construct($w, $h, $radius,$class)
    {
        $this->w = $w;
        $this->h = $h;
        $this->class = $class;
        $this->radius = $radius;
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
