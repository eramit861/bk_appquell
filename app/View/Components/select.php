<?php

namespace App\View\Components;

use Illuminate\View\Component;

class select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $label;
    public $divClass;
    public $type;
    public $selectClass;

    public function __construct($name = null, $label = null, $divClass = null, $type = null, $selectClass = null)
    {

        $this->name = $name;
        $this->label = $label;
        $this->divClass = $divClass;
        $this->type = $type;
        $this->selectClass = $selectClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
