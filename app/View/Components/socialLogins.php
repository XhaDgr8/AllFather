<?php

namespace App\View\Components;

use Illuminate\View\Component;

class socialLogins extends Component
{
    public $bgColor;
    public $icon;
    public $w;
    public $h;
    public $alt;
    public $url;

    /**
     * Create a new component instance.
     *
     * @param $bgColor
     * @param $icon
     * @param $w
     * @param $h
     * @param $alt
     */
    public function __construct($bgColor, $icon, $w, $h, $alt, $url)
    {
        $this->bgColor = $bgColor;
        $this->icon = $icon;
        $this->w = $w;
        $this->h = $h;
        $this->alt = $alt;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.social-logins');
    }
}
