<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
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
    public $inputClass;
    public $placeholder;
    public $value;

    public function __construct($name = null, $label = null, $divClass = null, $type = null, $inputClass = null, $placeholder = null, $value = null)
    {

        $this->name = $name;
        $this->label = $label;
        $this->divClass = $divClass;
        $this->type = $type;
        $this->inputClass = $inputClass;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
