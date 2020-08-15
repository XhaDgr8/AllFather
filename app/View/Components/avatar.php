<?php

namespace App\View\Components;

use Illuminate\View\Component;

class avatar extends Component
{
    public $w;
    public $h;
    public $shadow;

    /**
     * Create a new component instance.
     *
     * @param $w
     * @param $h
     * @param $shadow
     */
    public function __construct($w, $h, $shadow)
    {
        $this->w = $w;
        $this->h = $h;
        $this->shadow = $shadow;
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
