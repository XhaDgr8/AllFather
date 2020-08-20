<?php

namespace App\View\Components;

use Illuminate\View\Component;

class assigner extends Component
{
    public $assigner;
    public $class;

    /**
     * Create a new component instance.
     *
     * @param $assigner
     * @param $class
     */
    public function __construct($assigner, $class)
    {
        //
        $this->assigner = $assigner;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.assigner');
    }
}
