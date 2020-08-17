<?php

namespace App\View\Components;

use Illuminate\View\Component;

class textInput extends Component
{
    public $name;
    public $value;
    public $type;
    public $label;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $value
     * @param $type
     * @param $label
     */
    public function __construct($name, $value, $type, $label)
    {
        //
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.text-input');
    }
}
