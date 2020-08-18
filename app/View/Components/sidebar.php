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

}
