<?php

namespace App\View\Components;

use Illuminate\View\Component;

class textInput extends Component
{
    public $name;
    public $value;
    public $type;
    public $label;
    public $class;
    public $attr;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $value
     * @param $type
     * @param $label
     * @param $attr
     * @param $class
     */
    public function __construct($name, $value, $type, $label, $attr, $class)
    {
        //
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->label = $label;
        $this->class = $class;
        $this->attr = $attr;
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
