<?php

namespace App\View\Components;

use Illuminate\View\Component;

class icon extends Component
{
    public $w;
    public $h;
    public $i;
    public $class;

    public function __construct($i,$w, $h, $class)
    {
        $this->w = $w;
        $this->h = $h;
        $this->i = $i;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.icon');
    }
}
